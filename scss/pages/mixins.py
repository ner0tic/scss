""" Mixins. """

from datetime import datetime

from django.db import models
from django.core.exceptions import ValidationError
from django.utils.translation import gettext_lazy as _
from django.utils.text import slugify


class SlugMixin(models.Model):
    """Generate and populate a slug field based on the __str__ method."""

    slug = models.SlugField(max_length=255, unique=True, blank=True)

    class Meta:
        abstract = True

    def generate_slug(self, field=None):
        if field:
            if hasattr(self, field):
                return slugify(f"{self.field}")
        else:
            if hasattr(self, "get_full_name"):
                return slugify(f"{self.get_full_name()}")
            if hasattr(self, "title"):
                return slugify(f"{self.title}")
            if hasattr(self, "name"):
                return slugify(self.name)
        return slugify(self.__str__)

    def save(self, *args, **kwargs):
        if not self.slug:
            self.slug = self.generate_slug()
            # Ensure the slug is unique
            original_slug = self.slug
            counter = 1
            while self.__class__.objects.filter(slug=self.slug).exists():
                self.slug = f"{original_slug}-{counter}"
                counter += 1
        super().save(*args, **kwargs)


class NameSlugMixin(models.Model):
    """Generate and populate a slug field based on the name field."""

    slug = models.SlugField(max_length=255, unique=True, blank=True)

    class Meta:
        abstract = True

    def generate_slug(self):
        if hasattr(self, "get_full_name"):
            return slugify(f"{self.get_full_name()}")
        if hasattr(self, "title"):
            return slugify(f"{self.title}")
        return slugify(self.name)

    def save(self, *args, **kwargs):
        if not self.slug:
            self.slug = self.generate_slug()
            # Ensure the slug is unique
            original_slug = self.slug
            counter = 1
            while self.__class__.objects.filter(slug=self.slug).exists():
                self.slug = f"{original_slug}-{counter}"
                counter += 1
        super().save(*args, **kwargs)


class TimeStampedModelMixin(models.Model):
    created_at = models.DateTimeField(auto_now=True)
    updated_at = models.DateTimeField(auto_now=True)

    class Meta:
        abstract = True


class BaseModelMixin(SlugMixin, TimeStampedModelMixin, models.Model):
    name = models.CharField(max_length=100)
    description = models.TextField()

    class Meta:
        abstract = True

    def __str__(self):
        return f"{self.name}"


class DateRangeMixin(models.Model):
    start = models.DateTimeField(_("start"), default=datetime.now)
    end = models.DateTimeField(_("end"))

    def clean(self):
        if self.end <= self.start:
            raise ValidationError(_("End date must be after start date"))

    class Meta:
        abstract = True
