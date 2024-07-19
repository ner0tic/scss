""" Faculty Related Managers. """

from django.contrib.auth.models import BaseUserManager
from pages.managers import AbstractBaseManager

from user.models import User
from .querysets import FacultyQuerySet

class FacultyManager(BaseUserManager):
    """Faculty Manager."""

    def get_queryset(self, *args, **kwargs):
        results = super().get_queryset(*args, **kwargs)
        return results.filter(role=User.Role.FACULTY)

