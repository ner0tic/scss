# pages/fields.py
from typing import Any
from django.core.exceptions import ValidationError
from django.db import models
from django.utils.timezone import now
from datetime import date, datetime
from collections.abc import Callable, Iterable, Sequence

DEFAULT_CHOICES_NAME = 'STATUS'

class AutoCreatedField(models.DateTimeField):
    """
    A DateTimeField that automatically populates itself at
    object creation.

    By default, sets editable=False, default=datetime.now.

    """

    def __init__(self, *args: Any, **kwargs: Any):
        kwargs.setdefault('editable', False)
        kwargs.setdefault('default', now)
        super().__init__(*args, **kwargs)


class AutoLastModifiedField(AutoCreatedField):
    """
    A DateTimeField that updates itself on each save() of the model.

    By default, sets editable=False and default=datetime.now.

    """
    def get_default(self) -> datetime:
        """Return the default value for this field."""
        if not hasattr(self, "_default"):
            self._default = super().get_default()
        return self._default

    def pre_save(self, model_instance: models.Model, add: bool) -> datetime:
        value = now()
        if add:
            current_value = getattr(model_instance, self.attname, self.get_default())
            if current_value != self.get_default():
                # when creating an instance and the modified date is set
                # don't change the value, assume the developer wants that
                # control.
                value = getattr(model_instance, self.attname)
            else:
                for field in model_instance._meta.get_fields():
                    if isinstance(field, AutoCreatedField):
                        value = getattr(model_instance, field.name)
                        break
        setattr(model_instance, self.attname, value)
        return value


class StatusField(models.CharField):
    """
    A CharField that looks for a ``STATUS`` class-attribute and
    automatically uses that as ``choices``. The first option in
    ``STATUS`` is set as the default.

    Also has a default max_length so you don't have to worry about
    setting that.

    Also features a ``no_check_for_status`` argument to make sure
    South can handle this field when it freezes a model.
    """

    def __init__(
        self,
        *args: Any,
        no_check_for_status: bool = False,
        choices_name: str = DEFAULT_CHOICES_NAME,
        **kwargs: Any
    ):
        kwargs.setdefault('max_length', 100)
        self.check_for_status = not no_check_for_status
        self.choices_name = choices_name
        super().__init__(*args, **kwargs)

    def prepare_class(self, sender: type[models.Model], **kwargs: Any) -> None:
        if not sender._meta.abstract and self.check_for_status:
            assert hasattr(sender, self.choices_name), \
                f"To use StatusField, the model '{sender.__name__}' must have a {self.choices_name} choices class attribute." \

            self.choices = getattr(sender, self.choices_name)
            if not self.has_default():
                self.default = tuple(getattr(sender, self.choices_name))[0][0]  # set first as default

    def contribute_to_class(self, cls: type[models.Model], name: str, *args: Any, **kwargs: Any) -> None:
        models.signals.class_prepared.connect(self.prepare_class, sender=cls)
        # we don't set the real choices until class_prepared (so we can rely on
        # the STATUS class attr being available), but we need to set some dummy
        # choices now so the super method will add the get_FOO_display method
        self.choices = [(0, 'dummy')]
        super().contribute_to_class(cls, name, *args, **kwargs)

    def deconstruct(self) -> tuple[str, str, Sequence[Any], dict[str, Any]]:
        name, path, args, kwargs = super().deconstruct()
        kwargs['no_check_for_status'] = True
        return name, path, args, kwargs


class MonitorField(models.DateTimeField):
    """
    A DateTimeField that monitors another field on the same model and
    sets itself to the current date/time whenever the monitored field
    changes.

    """

    def __init__(self, *args: Any, monitor: str, when: Iterable[Any] | None = None, **kwargs: Any):
        default = None if kwargs.get("null") else now
        kwargs.setdefault('default', default)
        self.monitor = monitor
        self.when = None if when is None else set(when)
        super().__init__(*args, **kwargs)

    def contribute_to_class(self, cls: type[models.Model], name: str, *args: Any, **kwargs: Any) -> None:
        self.monitor_attname = f'_monitor_{name}'
        models.signals.post_init.connect(self._save_initial, sender=cls)
        super().contribute_to_class(cls, name, *args, **kwargs)

    def get_monitored_value(self, instance: models.Model) -> Any:
        return getattr(instance, self.monitor)

    def _save_initial(self, sender: type[models.Model], instance: models.Model, **kwargs: Any) -> None:
        if self.monitor in instance.get_deferred_fields():
            # Fix related to issue #241 to avoid recursive error on double monitor fields
            return
        setattr(instance, self.monitor_attname, self.get_monitored_value(instance))

    def pre_save(self, model_instance: models.Model, add: bool) -> Any:
        value = now()
        previous = getattr(model_instance, self.monitor_attname, None)
        current = self.get_monitored_value(model_instance)
        if previous != current and (self.when is None or current in self.when):
            setattr(model_instance, self.attname, value)
            self._save_initial(model_instance.__class__, model_instance)
        return super().pre_save(model_instance, add)

    def deconstruct(self) -> tuple[str, str, Sequence[Any], dict[str, Any]]:
        name, path, args, kwargs = super().deconstruct()
        kwargs['monitor'] = self.monitor
        if self.when is not None:
            kwargs['when'] = self.when
        return name, path, args, kwargs
