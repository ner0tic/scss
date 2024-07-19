""" Department Related Models. """

from django.db import models
from django.urls import reverse

from pages.mixins import models as mixins


class Department(mixins.NameDescriptionMixin, mixins.TimestampMixin, mixins.SoftDeleteMixin, mixins.AuditMixin, mixins.SlugMixin, mixins.ActiveMixin, mixins.ImageMixin, mixins.ParentChildMixin, models.Model):
    """Department Model."""

    abbreviation = models.CharField(max_length=50)
    facility = models.ForeignKey(
        "Facility", on_delete=models.CASCADE, related_name="departments"
    )

    def __str__(self):
        return self.name

    def get_absolute_url(self):
        return reverse("department_show", kwargs={"department_slug": self.slug})
