""" Facility Related Models. """
from user.models import User
from django.db import models
from django.contrib.auth.models import BaseUserManager
from django.db.models.signals import post_save
from django.dispatch import receiver
from django.contrib.contenttypes.fields import GenericRelation
from pages.mixins import NameSlugMixin

class Facility(NameSlugMixin, models.Model):
    """Facility Model."""

    name = models.CharField(max_length=100)
    description = models.TextField()

    address = GenericRelation("address.Address")
    organization = models.ForeignKey(
        "organization.Organization", on_delete=models.CASCADE
    )

    def __str__(self):
        return self.name


class Quarters(NameSlugMixin, models.Model):
    # Define the different types of quarters
    FACTION_QUARTERS = 'faction'
    LEADER_QUARTERS = 'leader'
    ATTENDEE_QUARTERS = 'attendee'
    FACULTY_QUARTERS = 'faculty'
    OTHER_QUARTERS = 'other'

    QUARTERS_TYPES = (
        (FACTION_QUARTERS, 'Faction Quarters'),
        (LEADER_QUARTERS, 'Leader Quarters'),
        (ATTENDEE_QUARTERS, 'Attendee Quarters'),
        (FACULTY_QUARTERS, 'Faculty Quarters'),
        (OTHER_QUARTERS, 'Other Quarters'),
    )

    name = models.CharField(max_length=100)
    description = models.TextField()
    capacity = models.IntegerField()
    type = models.CharField(max_length=50, choices=QUARTERS_TYPES, default=OTHER_QUARTERS)

    facility = models.ForeignKey("Facility", on_delete=models.CASCADE, related_name='quarters')

    def __str__(self):
        return self.name

    @property
    def is_faction(self):
        return self.type == self.FACTION_QUARTERS

    @property
    def is_leader(self):
        return self.type == self.LEADER_QUARTERS

    @property
    def is_attendee(self):
        return self.type == self.ATTENDEE_QUARTERS

    @property
    def is_faculty(self):
        return self.type == self.FACULTY_QUARTERS

    @property
    def is_other(self):
        return self.type == self.OTHER_QUARTERS

class Department(NameSlugMixin, models.Model):
    """Department Model."""

    name = models.CharField(max_length=100)
    abbreviation = models.CharField(max_length=50)
    description = models.TextField()

    parent = models.ForeignKey(
        "self", on_delete=models.CASCADE, null=True, blank=True, related_name="children"
    )
    facility = models.ForeignKey("Facility", on_delete=models.CASCADE, related_name='departments')

    def __str__(self):
        return self.name


class FacultyManager(BaseUserManager):
    """Faculty Manager."""

    def get_queryset(self, *args, **kwargs):
        results = super().get_queryset(*args, **kwargs)
        return results.filter(role=User.Role.FACULTY)


class Faculty(User):
    base_role = User.Role.FACULTY

    faculty = FacultyManager()

    class Meta:
        proxy = True

    def welcome(self):
        return "Only for faculty"


@receiver(post_save, sender=Faculty)
def create_user_profile(sender, instance, created, **kwargs):
    if created and instance.role == "FACULTY":
        FacultyProfile.objects.create(user=instance)


class FacultyProfile(models.Model):
    """Faculty Profile Model."""

    user = models.OneToOneField(User, on_delete=models.CASCADE)

    facility = models.ForeignKey("Facility", on_delete=models.CASCADE, null=True, blank=True)
    organization = models.ForeignKey(
        "organization.Organization",
        on_delete=models.CASCADE,
        null=True,
        blank=True
    )
    # enrollments
    address = GenericRelation("address.Address", null=True, blank=True)
