""" Temporal Related Models. """

from django.db import models

from pages.mixins import models as mixins


class AbstractTemporalHierarchy(mixins.DateRangeMixin, mixins.NameDescriptionMixin, mixins.TimestampMixin, mixins.SoftDeleteMixin, mixins.AuditMixin, mixins.SlugMixin, mixins.ActiveMixin, models.Model):
    """Abstract Temporal Hierarchy Model."""

    class Meta:
        """Metadata."""

        abstract = True
        ordering = ["start"]


class Week(AbstractTemporalHierarchy):
    """Week Model."""

    facility_enrollment = models.ForeignKey(
        "FacilityEnrollment", on_delete=models.CASCADE
    )


class Period(AbstractTemporalHierarchy):
    """Period Model."""

    week = models.ForeignKey(Week, on_delete=models.CASCADE)
