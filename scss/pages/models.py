from django.contrib.auth.models import Permission
from django.contrib.auth import get_user_model
from django.db import models
from django.urls import reverse
from django.utils import timezone
from typing import Any

from .fields import AutoCreatedField, AutoLastModifiedField, StatusField, MonitorField

User = get_user_model()

class DashboardLayout(models.Model):
    """
    Represents the layout configuration for a user's dashboard.
    
    Args:
        user: The user associated with the dashboard layout.
        layout: The configuration of the dashboard layout.
    """
    user = models.OneToOneField(User, on_delete=models.CASCADE)
    layout = models.TextField()
    def __str__(self):
        return f'{self.user.username} Dashboard Layout'


class Message(models.Model):
    """
    Represents a message sent between users.
    
    Args:
        sender: The user who sent the message.
        receiver: The user who received the message.
        content: The content of the message.
        timestamp: The timestamp when the message was sent.
        read: Indicates if the message has been read.
    """
    sender = models.ForeignKey(User, related_name='sent_messages', on_delete=models.CASCADE)
    receiver = models.ForeignKey(User, related_name='received_messages', on_delete=models.CASCADE)
    content = models.TextField()
    timestamp = models.DateTimeField(default=timezone.now)
    read = models.BooleanField(default=False)

    def __str__(self):
        return f'Message from {self.sender} to {self.receiver}'


class Notification(models.Model):
    """
    Represents a notification for a user.
    
    Args:
        user: The user associated with the notification.
        message: The message related to the notification.
        content: The content of the notification.
        timestamp: The timestamp when the notification was created.
        read: Indicates if the notification has been read.
    """
    user = models.ForeignKey(User, related_name='notifications', on_delete=models.CASCADE)
    message = models.ForeignKey(Message, related_name='notifications', on_delete=models.CASCADE, null=True, blank=True)
    content = models.TextField()
    timestamp = models.DateTimeField(default=timezone.now)
    read = models.BooleanField(default=False)

    def __str__(self):
        return f'Notification for {self.user}'


class MenuItem(models.Model):
    """
    Represents a menu item.
    
    Args:
        title: The title of the menu item.
        url_name: The name of the URL associated with the menu item.
        url_params: Parameters for the URL.
        image: An optional image for the menu item.
        image_path: The relative path to a static image.
        css_class: The CSS class for styling the menu item.
        parent: The parent menu item.
        permissions: Permissions required to access the menu item.
        visible_to: Specifies who can see the menu item.
    """
    title = models.CharField(max_length=100, null=True)  # Temporarily allow null
    url_name = models.CharField(max_length=100, null=True)  # Temporarily allow null
    url_params = models.JSONField(default=dict, null=True, blank=True)
    image = models.ImageField(
        upload_to="menu_images/",
        blank=True,
        null=True
    )  # Optional image field
    image_path = models.CharField(
        max_length=255,
        blank=True,
        null=True,
        help_text="Relative path to a static image",
    )
    css_class = models.CharField(
        max_length=100,
        blank=True,
        null=True,
        help_text="CSS class for the menu item"
    )
    parent = models.ForeignKey(
        "self",
        null=True,
        blank=True,
        related_name="children",
        on_delete=models.CASCADE
    )
    permissions = models.ManyToManyField(Permission, blank=True)
    visible_to = models.CharField(
        max_length=20,
        choices=(
            ("all", "All"),
            ("authenticated", "Authenticated"),
            ("guest", "Guest"),
        ),
        default="all",
    )

    def get_url(self):
        """
        Get the URL for the menu item.
        
        Returns:
            str: The URL for the menu item.
        """
        try:
            if self.url_params:
                return reverse(self.url_name, kwargs=self.url_params)
            else:
                return reverse(self.url_name)
        except Exception as e:
            # Handle exceptions or return a fallback URL
            return "#"

    def __str__(self):
        return self.title

    class Meta:
        ordering = ["menus", "parent__id", "id"]


class Menu(models.Model):
    """
    Represents a menu.
    
    Args:
        name: The name of the menu.
        permissions: Permissions required to access the menu.
        items: Menu items associated with the menu.
    """
    name = models.CharField(max_length=100)
    permissions = models.ManyToManyField(Permission, blank=True)
    items = models.ManyToManyField(MenuItem, related_name='menus')

    def __str__(self):
        return self.name

class TimeStampedModel(models.Model):
    """
    An abstract base class model that provides self-updating
    ``created`` and ``modified`` fields.
    """
    
    created = AutoCreatedField('created')
    modified = AutoLastModifiedField('modified')

    def save(self, *args: Any, **kwargs: Any) -> None:
        """
        Overriding the save method to update the modified field.
        """
    
    class Meta:
        abstract = True


class TimeFramedModel(models.Model):
    """
    An abstract base class model that provides ``start``
    and ``end`` fields to record a timeframe.
    """
    
    start = models.DateTimeField('start', null=True, blank=True)
    end = models.DateTimeField('end', null=True, blank=True)

    class Meta:
        abstract = True


class StatusModel(models.Model):
    """
    An abstract base class model with a ``status`` field that
    automatically uses a ``STATUS`` class attribute of choices, a
    ``status_changed`` date-time field that records when ``status``
    was last modified, and an automatically-added manager for each
    status that returns objects with that status only.
    """
    
    status = StatusField('status')
    status_changed = MonitorField('status changed', monitor='status')

    def save(self, *args: Any, **kwargs: Any) -> None:
        """
        Overriding the save method to update the status_changed field.
        """
    
    class Meta:
        abstract = True


def add_status_query_managers(sender: type[models.Model], **kwargs: Any) -> None:
    """
    Add a Querymanager for each status item dynamically.
    """
    if not issubclass(sender, StatusModel):
        return

    default_manager = sender._meta.default_manager
    assert default_manager is not None

    for value, display in getattr(sender, 'STATUS', ()):
        if _field_exists(sender, value):
            raise ImproperlyConfigured(
                "StatusModel: Model '%s' has a field named '%s' which "
                "conflicts with a status of the same name."
                % (sender.__name__, value)
            )
        sender.add_to_class(value, QueryManager(status=value))

    sender._meta.default_manager_name = default_manager.name


def add_timeframed_query_manager(sender: type[models.Model], **kwargs: Any) -> None:
    """
    Add a QueryManager for a specific timeframe.
    """
    if not issubclass(sender, TimeFramedModel):
        return
    if _field_exists(sender, 'timeframed'):
        raise ImproperlyConfigured(
            "Model '%s' has a field named 'timeframed' "
            "which conflicts with the TimeFramedModel manager."
            % sender.__name__
        )
    sender.add_to_class('timeframed', QueryManager(
        (models.Q(start__lte=now) | models.Q(start__isnull=True))
        & (models.Q(end__gte=now) | models.Q(end__isnull=True))
    ))


models.signals.class_prepared.connect(add_status_query_managers)
models.signals.class_prepared.connect(add_timeframed_query_manager)


def _field_exists(model_class: type[models.Model], field_name: str) -> bool:
    """
    Check if a field exists in the model class.
    """
    return field_name in [f.attname for f in model_class._meta.local_fields]
