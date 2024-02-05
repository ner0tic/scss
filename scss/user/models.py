""" User Related Models. """
from django.db import models
from django.contrib.auth.models import AbstractUser, BaseUserManager
from django.db.models.signals import post_save
from django.dispatch import receiver
from pages.mixins import NameSlugMixin

class User(NameSlugMixin, AbstractUser):
    """User Model."""

    class Role(models.TextChoices):
        """User Role Model."""

        ADMIN = "ADMIN", "Admin"
        FACULTY = "FACULTY", "Faculty"
        LEADER = "LEADER", "Leader"
        ATTENDEE = "ATTENDEE", "Attendee"
        OTHER = "OTHER", "Other"

    base_role = Role.OTHER

    role = models.CharField(max_length=50, choices=Role.choices)

    def save(self, *args, **kwargs):
        """Save Method."""
        if not self.pk:
            self.role = self.base_role
            return super().save(*args, **kwargs)
