""" Faction Related Models. """
from user.models import User
from django.db import models
from django.contrib.auth.models import BaseUserManager
from django.db.models.signals import post_save
from django.dispatch import receiver
from django.contrib.contenttypes.fields import GenericRelation
from pages.mixins import NameSlugMixin

class Faction(NameSlugMixin, models.Model):
    """Faction Model."""

    name = models.CharField(max_length=100)
    abbreviation = models.CharField(max_length=50)
    description = models.TextField()

    organization = models.ForeignKey(
        "organization.Organization", on_delete=models.CASCADE
    )

    # enrollments

    def __str__(self):
        return self.name


class AttendeeManager(BaseUserManager):
    """Attendee Manager."""

    def get_queryset(self, *args, **kwargs):
        """Get Queryset."""
        results = super().get_queryset(*args, **kwargs)
        return results.filter(role=User.Role.ATTENDEE)


class Attendee(User):
    """Attendee Model."""

    base_role = User.Role.ATTENDEE

    attendee = AttendeeManager()

    class Meta:
        proxy = True

    def welcome(self):
        return "Only for attendees"


@receiver(post_save, sender=Attendee)
def create_user_profile(sender, instance, created, **kwargs):
    if created and instance.role == "ATTENDEE":
        AttendeeProfile.objects.create(user=instance)


class AttendeeProfile(models.Model):
    """Attendee Profile Model."""

    user = models.OneToOneField(User, on_delete=models.CASCADE)

    faction = models.ForeignKey("Faction", on_delete=models.CASCADE, null=True, blank=True)
    organization = models.ForeignKey(
        "organization.Organization",
        on_delete=models.CASCADE,
        null=True,
        blank=True
    )
    # enrollments
    address = GenericRelation("address.Address", null=True, blank=True)


class LeaderManager(BaseUserManager):
    """Leader Manager."""

    def get_queryset(self, *args, **kwargs):
        results = super().get_queryset(*args, **kwargs)
        return results.filter(role=User.Role.LEADER)


class Leader(User):
    base_role = User.Role.LEADER

    leader = LeaderManager()

    class Meta:
        proxy = True

    def welcome(self):
        return "Only for leaders"


@receiver(post_save, sender=Leader)
def create_user_profile(sender, instance, created, **kwargs):
    if created and instance.role == "LEADER":
        LeaderProfile.objects.create(user=instance)


class LeaderProfile(models.Model):
    """Leader Profile Model."""

    user = models.OneToOneField(User, on_delete=models.CASCADE)

    faction = models.ForeignKey("Faction", on_delete=models.CASCADE, null=True, blank=True)
    organization = models.ForeignKey(
        "organization.Organization",
        on_delete=models.CASCADE,
        null=True,
        blank=True
    )
    # enrollments
    address = GenericRelation("address.Address", null=True, blank=True)
