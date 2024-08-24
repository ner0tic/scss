# enrollment/models/faction.py
"""Faction Enrollment Related Models."""

from django.db import models
from django.core.exceptions import ValidationError

from pages.mixins import models as mixins

from .temporal import AbstractTemporalHierarchy, Week
from .facility import FacilityClassEnrollment
from ..managers import (
    FactionEnrollmentManager,
    LeaderEnrollmentManager,
    AttendeeEnrollmentManager,
)


class FactionEnrollment(AbstractTemporalHierarchy):
    """Faction Enrollment Model.

    Represents an enrollment period for a specific faction during a week.
    """

    faction = models.ForeignKey(
        "faction.Faction",
        on_delete=models.CASCADE,
        related_name="faction_enrollments",
        verbose_name="Faction",
    )
    week = models.ForeignKey(
        Week,
        on_delete=models.CASCADE,
        related_name="faction_enrollments",
        verbose_name="Week",
    )
    quarters = models.ForeignKey(
        "facility.Quarters",
        on_delete=models.CASCADE,
        related_name="faction_enrollments",
        verbose_name="Quarters",
    )

    objects = FactionEnrollmentManager()

    class Meta:
        """Metadata."""

        verbose_name = "Faction Enrollment"
        verbose_name_plural = "Faction Enrollments"
        ordering = ["start"]

    def __str__(self):
        """String representation."""
        return f"{self.faction.name} - {self.week}"

    def clean(self):
        """Ensure the week is within the temporal range."""
        super().clean()
        if (
            self.start
            and self.end
            and (self.week.start < self.start or self.week.end > self.end)
        ):
            raise ValidationError("Week dates must fall within the enrollment period.")


class LeaderEnrollment(AbstractTemporalHierarchy):
    """Leader Enrollment Model.

    Represents the enrollment of a leader in a specific faction during an enrollment period.
    """

    faction_enrollment = models.ForeignKey(
        FactionEnrollment,
        on_delete=models.CASCADE,
        related_name="leader_enrollments",
        verbose_name="Faction Enrollment",
    )
    leader = models.ForeignKey(
        "faction.Leader",
        on_delete=models.CASCADE,
        related_name="leader_enrollments",
        verbose_name="Leader",
    )
    quarters = models.ForeignKey(
        "facility.Quarters",
        on_delete=models.SET_NULL,
        null=True,
        blank=True,
        related_name="leader_enrollments",
        verbose_name="Quarters",
    )

    objects = LeaderEnrollmentManager()

    class Meta:
        """Metadata."""

        verbose_name = "Leader Enrollment"
        verbose_name_plural = "Leader Enrollments"
        ordering = ["start"]

    def __str__(self):
        """String representation."""
        return f"{self.leader} - {self.faction_enrollment}"


class AttendeeEnrollment(
    mixins.NameDescriptionMixin,
    mixins.TimestampMixin,
    mixins.SoftDeleteMixin,
    mixins.AuditMixin,
    mixins.SlugMixin,
    mixins.ActiveMixin,
    models.Model,
):
    """Attendee Enrollment Model.

    Represents the enrollment of an attendee in a specific faction during an enrollment period.
    """

    attendee = models.ForeignKey(
        "faction.Attendee",
        on_delete=models.CASCADE,
        related_name="attendee_enrollments",
        verbose_name="Attendee",
    )
    faction_enrollment = models.ForeignKey(
        FactionEnrollment,
        on_delete=models.CASCADE,
        related_name="attendee_enrollments",
        verbose_name="Faction Enrollment",
    )
    quarters = models.ForeignKey(
        "facility.Quarters",
        on_delete=models.CASCADE,
        related_name="attendee_enrollments",
        verbose_name="Quarters",
    )

    objects = AttendeeEnrollmentManager()

    class Meta:
        """Metadata."""

        verbose_name = "Attendee Enrollment"
        verbose_name_plural = "Attendee Enrollments"
        ordering = ["attendee__last_name", "attendee__first_name"]

    def __str__(self):
        """String representation."""
        return f"{self.attendee} - {self.faction_enrollment} - {self.quarters}"

    def clean(self):
        """Ensure that the attendee's quarters match the faction's quarters."""
        super().clean()
        if self.quarters and self.quarters != self.faction_enrollment.quarters:
            raise ValidationError("Attendee quarters must match the faction quarters.")


class AttendeeClassEnrollment(
    mixins.NameDescriptionMixin,
    mixins.TimestampMixin,
    mixins.SoftDeleteMixin,
    mixins.AuditMixin,
    mixins.SlugMixin,
    mixins.ActiveMixin,
    models.Model,
):
    """Attendee Class Enrollment Model.

    Represents the enrollment of an attendee in a specific class during an enrollment period.
    """

    attendee_enrollment = models.ForeignKey(
        AttendeeEnrollment,
        on_delete=models.CASCADE,
        related_name="class_enrollments",
        verbose_name="Attendee Enrollment",
    )
    facility_class_enrollment = models.ForeignKey(
        FacilityClassEnrollment,
        on_delete=models.CASCADE,
        related_name="attendee_class_enrollments",
        verbose_name="Facility Class Enrollment",
    )

    class Meta:
        """Metadata."""

        verbose_name = "Attendee Class Enrollment"
        verbose_name_plural = "Attendee Class Enrollments"
        ordering = [
            "attendee_enrollment__attendee__last_name",
            "attendee_enrollment__attendee__first_name",
        ]

    def __str__(self):
        """String representation."""
        return f"{self.attendee_enrollment.attendee} - {self.facility_class_enrollment}"

    def clean(self):
        """Ensure that the class is active and within the correct enrollment period."""
        super().clean()
        if not self.facility_class_enrollment.is_active:
            raise ValidationError(
                f"The class {self.facility_class_enrollment} is not active."
            )
