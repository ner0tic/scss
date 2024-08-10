# faction/models/attendee.py
""" Attendee Related Models. """

from django.contrib.contenttypes.fields import GenericRelation
from django.db import models
from django.db.models.signals import post_save
from django.dispatch import receiver
from django.forms import ValidationError
from django.urls import reverse

from pages.mixins import models as mixins
from user.models import User, UserProfile
#rom organization.models import Organization

#from .faction import Faction
from ..managers.attendee import AttendeeManager


class Attendee(
    User,
    mixins.SlugMixin,
    mixins.TimestampMixin,
    mixins.SoftDeleteMixin,
    mixins.AuditMixin,
    mixins.ActiveMixin,
    mixins.ImageMixin,
):
    """Attendee Model."""

    user_type = User.UserType.ATTENDEE
    faction = models.ForeignKey(
        "faction.Faction", on_delete=models.SET_NULL, null=True, blank=True
    )
    organization = models.ForeignKey(
        "organization.Organization", on_delete=models.SET_NULL, null=True, blank=True
    )
    # address = GenericRelation("address.Address", null=True, blank=True)
    address = models.CharField(max_length=255, null=True, blank=True)

    def get_root_faction(self):
        if self.faction.parent:
            return self.faction.parent.get_root_faction()
        return self.faction

    attendee = AttendeeManager()

    def welcome(self):
        return "Only for attendees"

    def get_absolute_url(self):
        return reverse("attendee_show", kwargs={"attendee_slug": self.slug})


class AttendeeProfile(UserProfile):
    organization = models.ForeignKey(
        "organization.Organization", on_delete=models.SET_NULL, null=True, blank=True
    )
    faction = models.ForeignKey(
        "faction.Faction", on_delete=models.SET_NULL, null=True, blank=True
    )
    
    objects = AttendeeManager()


@receiver(post_save, sender=Attendee)
def create_user_profile(sender, instance, created, **kwargs):
    if created and instance.user_type == "ATTENDEE":
        AttendeeProfile.objects.create(user=instance)
