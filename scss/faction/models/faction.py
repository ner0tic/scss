# faction/models/faction.py
""" Faction Related Models. """

from django.contrib.contenttypes.fields import GenericRelation
from django.db import models
from django.db.models.signals import post_save
from django.dispatch import receiver
from django.forms import ValidationError
from django.urls import reverse

from user.models import User
from pages.mixins import models as mixins

from ..managers.faction import FactionManager


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
                f"Faction cannot be more than {self.organization.settings.max_faction_depth_depth} levels deep within the organization."
            )

    def save(self, *args, **kwargs):
        self.clean()
        super().save(*args, **kwargs)

    def get_root_faction(self):
        if self.parent:
            return self.parent.get_root_faction()
        return self

    def member_count(self, user_type='attendee', include_descendants=True):
        count = 0
        if user_type == 'attendee':
            count += self.attendeeprofile_set.count()
        elif user_type == 'leader':
            count += self.leaderprofile_set.count()
        # Add more user types as needed

        if include_descendants:
            for child in self.children.all():
                count += child.member_count(user_type, include_descendants)
        return count

    def with_sub_faction_count(self):
        return Faction.objects.with_sub_faction_count()