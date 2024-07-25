""" User Related Models. """

from django.contrib.auth.models import AbstractUser, UserManager
from django.db import models
from django.conf import settings

from pages.mixins import models as mixins
from faction.managers.attendee import AttendeeManager
from faction.managers.leader import LeaderManager


class User(AbstractUser):
    """User Model."""

    class UserType(models.TextChoices):
        """User Role Model."""

        ADMIN = "ADMIN", "Admin"
        ORGANIZATION_FACULTY = "ORGANIZATION FACULTY", "Organization Faculty"
        # ORGANIZATION_FACULTY_ADMIN = "ORGANIZATION_FACULTY_ADMIN", "Organization Faculty Admin"
        FACILITY_FACULTY = "FACILITY_FACULTY", "Facility Faculty"
        # FACILITY_FACULTY_ADMIN = "FACILITY_FACULTY_ADMIN", "Facility Faculty Admin"
        FACULTY = "FACULTY", "Faculty"
        LEADER = "LEADER", "Leader"
        # LEADER_ADMIN = "LEADER_ADMIN", "Primary Leader"
        ATTENDEE = "ATTENDEE", "Attendee"
        OTHER = "OTHER", "Other"

    user_type = models.CharField(max_length=50, choices=UserType.choices)
    is_admin = models.BooleanField(default=False)

    objects = UserManager()
    attendees = AttendeeManager()
    leaders = LeaderManager()

    def get_full_name(self):
        return f"{self.first_name} {self.last_name}"
    
    def get_profile(self):
        profile_mapping = {
            'faculty': getattr(self, 'facultyprofile', None),
            'attendee': getattr(self, 'attendeeprofile', None),
            'leader': getattr(self, 'leaderprofile', None),
            'admin': getattr(self, 'adminprofile', None),
        }
        return profile_mapping.get(self.user_type)
            


class UserProfile(models.Model):
    user = models.OneToOneField(settings.AUTH_USER_MODEL, on_delete=models.CASCADE)

    class Meta:
        abstract = True

class AdminProfile(UserProfile):
    user = models.OneToOneField(settings.AUTH_USER_MODEL, on_delete=models.CASCADE)
