""" Organization Related Models. """
from django.db import models
from django.core.exceptions import ValidationError
from pages.mixins import NameSlugMixin

class Organization(NameSlugMixin, models.Model):
    """Organization Model."""

    name = models.CharField(max_length=100)
    abbreviation = models.CharField(max_length=25)
    description = models.TextField()

    parent = models.ForeignKey(
        "self", on_delete=models.CASCADE, null=True, blank=True, related_name="children"
    )

    def __str__(self):
        return self.name

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
