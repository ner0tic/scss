# enrollment/models/temporal.py
"""Temporal Related Models."""

from django.db import models
from django.core.exceptions import ValidationError

from pages.mixins import models as mixins


class AbstractTemporalHierarchy(
    mixins.DateRangeMixin,
    mixins.NameDescriptionMixin,
    mixins.TimestampMixin,
    mixins.SoftDeleteMixin,
    mixins.AuditMixin,
    mixins.SlugMixin,
    mixins.ActiveMixin,
    models.Model,
):
    """Abstract Temporal Hierarchy Model.

    This abstract model represents a temporal entity with a date range, such as a week or period.
    """

    class Meta:
        """Metadata."""

        abstract = True
        ordering = ["start"]
        verbose_name = "Temporal Hierarchy"
        verbose_name_plural = "Temporal Hierarchies"

    def clean(self):
        """Ensure that the start date is before the end date."""
        super().clean()
        if self.start and self.end and self.start > self.end:
            raise ValidationError("The start date cannot be later than the end date.")

    def __str__(self):
        """String representation."""
        return f"{self.name} ({self.start} - {self.end})"


class Week(AbstractTemporalHierarchy):
    """Week Model.

    Represents a week associated with a specific facility enrollment.
    """

    facility_enrollment = models.ForeignKey(
        "FacilityEnrollment",
        on_delete=models.CASCADE,
        related_name="weeks",
        verbose_name="Facility Enrollment",
    )

    class Meta:
        """Metadata."""

        verbose_name = "Week"
        verbose_name_plural = "Weeks"
        ordering = ["start"]

    def get_periods(self):
        """Return all periods associated with this week."""
        return self.period_set.all()

    def __str__(self):
        """String representation."""
        return f"Week: {self.name} ({self.start} - {self.end})"


class Period(AbstractTemporalHierarchy):
    """Period Model.

    Represents a period within a specific week.
    """

    week = models.ForeignKey(
        Week, on_delete=models.CASCADE, related_name="periods", verbose_name="Week"
    )

    class Meta:
        """Metadata."""

        verbose_name = "Period"
        verbose_name_plural = "Periods"
        ordering = ["start"]

    def __str__(self):
        """String representation."""
        return f"Period: {self.name} ({self.start} - {self.end})"

    def get_week_name(self):
        """Return the name of the associated week."""
        return self.week.name
