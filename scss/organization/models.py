""" Organization Related Models. """

from django.core.exceptions import ValidationError
from django.db import models
from django.db.models import Prefetch
from django.urls import reverse

from pages.mixins import NameSlugMixin

from .managers import OrganizationManager


class Organization(NameSlugMixin, models.Model):
    """Organization Model."""

    name = models.CharField(max_length=100)
    abbreviation = models.CharField(max_length=25)
    description = models.TextField()

    parent = models.ForeignKey(
        "self", on_delete=models.CASCADE, null=True, blank=True, related_name="children"
    )

    objects = OrganizationManager()

    def __str__(self):
        return f"{self.name}"

    def clean(self):
        # Check for depth
        depth = 0
        current = self
        while current.parent is not None:
            depth += 1
            if depth > 2:  # Allowing 3 levels: 0, 1, 2
                raise ValidationError("Maximum hierarchy depth exceeded")
            current = current.parent

    def save(self, *args, **kwargs):
        self.clean()
        super().save(*args, **kwargs)

    def get_total_factions_count(self):
        total_count = self.factions.count()
        for child_org in self.children.all():
            total_count += child_org.get_total_factions_count()
        return total_count

    def get_descendant_ids(self):
        descendant_ids = [self.id]
        for child in self.children.all():
            descendant_ids.extend(child.get_descendant_ids())
        return descendant_ids
