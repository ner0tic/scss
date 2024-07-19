""" Leader Related Models. """

from django.contrib.contenttypes.fields import GenericRelation
from django.db import models
from django.db.models.signals import post_save
from django.dispatch import receiver
from django.forms import ValidationError
from django.urls import reverse

from pages.mixins import models as mixins
from user.models import User, UserProfile
from organization.models import Organization

from .leader import Leader
from ..managers import LeaderManager


class Leader(User, mixins.SlugMixin, mixins.TimestampMixin, mixins.SoftDeleteMixin, mixins.AuditMixin, mixins.ActiveMixin, mixins.ImageMixin):
    role = User.Role.LEADER
    faction = models.ForeignKey(
        "Faction", on_delete=models.CASCADE, null=True, blank=True
    )
    organization = models.ForeignKey(
        "organization.Organization", on_delete=models.CASCADE, null=True, blank=True
    )
    address = GenericRelation("address.Address", null=True, blank=True)

    leader = LeaderManager()

    class Meta:
        # proxy = True
        pass

    def welcome(self):
        return "Only for leaders"

    def get_absolute_url(self):
        return reverse("leader_show", kwargs={"leader_slug": self.slug})

class LeaderProfile(UserProfile):
    organization = models.ForeignKey("organization.Organization", on_delete=models.SET_NULL, null=True, blank=True)
    faction = models.ForeignKey("Faction", on_delete=models.SET_NULL, null=True, blank=True)

@receiver(post_save, sender=Leader)
def create_user_profile(sender, instance, created, **kwargs):
    if created and instance.role == "LEADER":
        LeaderProfile.objects.create(user=instance)
