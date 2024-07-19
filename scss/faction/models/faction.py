""" Faction Related Models. """

from django.contrib.contenttypes.fields import GenericRelation
from django.db import models
from django.db.models.signals import post_save
from django.dispatch import receiver
from django.forms import ValidationError
from django.urls import reverse

from user.models import User
from pages.mixins import models as mixins

from ..managers import FactionManager


class Faction(mixins.NameDescriptionMixin, mixins.TimestampMixin, mixins.SoftDeleteMixin, mixins.AuditMixin, mixins.SlugMixin, mixins.ActiveMixin, mixins.ImageMixin, mixins.ParentChildMixin, models.Model):
    """Faction Model."""

    abbreviation = models.CharField(max_length=50, null=True, blank=True)
    organization = models.ForeignKey(
        "organization.Organization", on_delete=models.CASCADE, related_name="factions"
    )

    objects = FactionManager()

    def __str__(self):
        return f"{self.organization.abbreviation}{self.name}"

    def get_absolute_url(self):
        return reverse("faction_show", kwargs={"faction_slug": self.slug})

    def get_depth(self):
        """
        Calculate the depth of the current node in the tree structure.

        Returns:
            int: The depth of the current node in the tree.
        """
        depth = 0
        parent = self.parent
        while parent:
            depth += 1
            parent = parent.parent
        return depth

    def clean(self):
        if self.get_depth() >= self.organization.settings.max_faction_depth:
            raise ValidationError(
                f"Faction cannot be more than {mself.organization.settings.max_faction_depth_depth} levels deep within the organization."
            )

    def save(self, *args, **kwargs):
        self.clean()
        super().save(*args, **kwargs)

    def get_root_faction(self):
        if self.parent:
            return self.parent.get_root_faction()
        return self