# user/models.py

from django.contrib.auth.models import AbstractUser, UserManager
from django.db import models
from django.conf import settings
from django.db.models.signals import post_save
from django.dispatch import receiver
from address.models import AddressField

from pages.mixins import models as mixins
from faction.managers.attendee import AttendeeManager
from faction.managers.leader import LeaderManager
from facility.managers.faculty import FacultyManager


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
    faculty = FacultyManager()

    def get_full_name(self):
        return f"{self.first_name} {self.last_name}"

    def get_profile(self):
        profile_mapping = {
            "ADMIN": getattr(self, "adminprofile", None),
            "ORGANIZATION_FACULTY": getattr(self, "organizationfacultyprofile", None),
            "FACILITY_FACULTY": getattr(self, "facilityfacultyprofile", None),
            "FACULTY": getattr(self, "facultyprofile", None),
            "LEADER": getattr(self, "leaderprofile", None),
            "ATTENDEE": getattr(self, "attendeeprofile", None),
            "OTHER": None,
        }
        return profile_mapping.get(self.user_type)


class UserProfile(models.Model):
    user = models.OneToOneField(settings.AUTH_USER_MODEL, on_delete=models.CASCADE)
    address = AddressField(blank=True, null=True)
    organization = models.ForeignKey(
        "organization.Organization", on_delete=models.CASCADE
    )

    class Meta:
        abstract = True

    def get_root_organization(self):
        return self.organization.get_root_organization()


class AdminProfile(UserProfile):
    class Meta:
        abstract = True


@receiver(post_save, sender=User)
def create_profile(sender, instance, created, **kwargs):
    if created and instance.user_type == "faculty":
        FacultyManager.objects.create(user=instance)
    elif created and instance.user_type == "attendee":
        AttendeeManager.objects.create(user=instance)
    elif created and instance.user_type == "leader":
        LeaderManager.objects.create(user=instance)


@receiver(post_save, sender=User)
def save_profile(sender, instance, **kwargs):
    if instance.user_type == "faculty" and hasattr(instance, "facultyprofile"):
        instance.facultyprofile.save()
    elif instance.user_type == "attendee" and hasattr(instance, "attendeeprofile"):
        instance.attendeeprofile.save()
    elif instance.user_type == "leader" and hasattr(instance, "leaderprofile"):
        instance.leaderprofile.save()
