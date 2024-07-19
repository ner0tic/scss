""" Quarters Related Models. """

from django.db import models
from django.urls import reverse

from pages.mixins import models as mixins

class QuartersType(mixins.NameDescriptionMixin, mixins.TimestampMixin, mixins.SoftDeleteMixin, mixins.AuditMixin, mixins.SlugMixin, mixins.ActiveMixin, mixins.ImageMixin, mixins.ParentChildMixin, models.Model):
    organization = models.ForeignKey(
        "organization.Organization", on_delete=models.SET_NULL, null=True, blank=True
    )

    def __str__(self):
        return f"{self.name}"


class Quarters(mixins.NameDescriptionMixin, mixins.TimestampMixin, mixins.SoftDeleteMixin, mixins.AuditMixin, mixins.SlugMixin, mixins.ActiveMixin, mixins.ImageMixin, mixins.ParentChildMixin, models.Model):
    """Quarters Model."""

    capacity = models.IntegerField()
    type = models.ForeignKey(
        "QuartersType", on_delete=models.CASCADE, related_name="quarters"
    )
    facility = models.ForeignKey(
        "Facility", on_delete=models.CASCADE, related_name="quarters"
    )

    def __str__(self):
        return self.name

    def get_absolute_url(self):
        return reverse("quarters_show", kwargs={"quarters_slug": self.slug})

