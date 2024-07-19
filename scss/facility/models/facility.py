""" Facility Related Models. """

from django.contrib.auth.models import BaseUserManager
from django.contrib.contenttypes.fields import GenericRelation
from django.db import models
from django.db.models.signals import post_save
from django.dispatch import receiver
from django.urls import reverse

from pages.mixins import models as mixins

class Facility(mixins.NameDescriptionMixin, mixins.TimestampMixin, mixins.SoftDeleteMixin, mixins.AuditMixin, mixins.SlugMixin, mixins.ActiveMixin, mixins.ImageMixin, mixins.ParentChildMixin, models.Model):
    """Facility Model."""

    address = GenericRelation("address.Address", null=True, blank=True)
    organization = models.ForeignKey(
        "organization.Organization", on_delete=models.CASCADE, related_name="facilities"
    )

    def __str__(self):
        return self.name

    def get_absolute_url(self):
        return reverse("facility_show", kwargs={"facility_slug": self.slug})

    def get_root_organization(self):
        return self.organization.get_root_organization()