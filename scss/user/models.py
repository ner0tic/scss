""" User Related Models. """

from django.contrib.auth.models import AbstractUser
from django.db import models


class User(AbstractUser):
    """User Model."""
    
    class UserType(models.TextChoices):
        """User Role Model."""

        ADMIN = "ADMIN", "Admin"
        ORGANIZATION_FACULTY = "ORGANIZATION FACULTY", "Organization Faculty"
        #ORGANIZATION_FACULTY_ADMIN = "ORGANIZATION_FACULTY_ADMIN", "Organization Faculty Admin"
        FACILITY_FACULTY = "FACILITY_FACULTY", "Facility Faculty"
        #FACILITY_FACULTY_ADMIN = "FACILITY_FACULTY_ADMIN", "Facility Faculty Admin"
        FACULTY= "FACULTY", "Faculty"
        LEADER = "LEADER", "Leader"
        #LEADER_ADMIN = "LEADER_ADMIN", "Primary Leader"
        ATTENDEE = "ATTENDEE", "Attendee"
        OTHER = "OTHER", "Other"

    user_type = models.CharField(max_length=50, choices=UserType.choices)

    def get_full_name(self):
        return f"{self.first_name} {self.last_name}"


class UserProfile(models.Model):
    user = models.OneToOneField('User', on_delete=models.CASCADE)

    class Meta:
        abstract = True

