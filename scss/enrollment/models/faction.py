""" Faction Enrollment Related Model. """

from django.db import models

from pages.mixins import models as mixins

from .temporal import AbstractTemporalHierarchy, Week
from .facility import FacilityClassEnrollment
from ..managers import (
    FactionEnrollmentManager,
    LeaderEnrollmentManager,
    AttendeeEnrollmentManager,
)

class FactionEnrollment(AbstractTemporalHierarchy):
    """Faction Enrollment Model."""

    faction = models.ForeignKey("faction.Faction", on_delete=models.CASCADE)
    week = models.ForeignKey(Week, on_delete=models.CASCADE)
    quarters = models.ForeignKey("facility.Quarters", on_delete=models.CASCADE)

    objects = FactionEnrollmentManager()


class LeaderEnrollment(AbstractTemporalHierarchy):
    """Leader Enrollment Model."""

    faction_enrollment = models.ForeignKey(
        FactionEnrollment, on_delete=models.CASCADE, related_name="leader_enrollments"
    )
    leader = models.ForeignKey(
        "faction.Leader", on_delete=models.CASCADE, related_name="leader_enrollments"
    )
    quarters = models.ForeignKey(
        "facility.Quarters", on_delete=models.SET_NULL, null=True, blank=True
    )

    objects = LeaderEnrollmentManager


class AttendeeEnrollment(mixins.NameDescriptionMixin, mixins.TimestampMixin, mixins.SoftDeleteMixin, mixins.AuditMixin, mixins.SlugMixin, mixins.ActiveMixin, models.Model):
    """Attendee Enrollment Model."""

    attendee = models.ForeignKey(
        "faction.Attendee",
        on_delete=models.CASCADE,
        related_name="attendee_enrollments",
    )
    faction_enrollment = models.ForeignKey(
        FactionEnrollment, on_delete=models.CASCADE, related_name="attendee_enrollments"
    )
    quarters = models.ForeignKey("facility.Quarters", on_delete=models.CASCADE)

    objects = AttendeeEnrollmentManager()

    def __str__(self):
        return f"{self.attendee} - {self.faction_enrollment} - {self.quarters}"


class AttendeeClassEnrollment(mixins.NameDescriptionMixin, mixins.TimestampMixin, mixins.SoftDeleteMixin, mixins.AuditMixin, mixins.SlugMixin, mixins.ActiveMixin, models.Model):
    """Attendee Class Enrollment Model."""

    attendee_enrollment = models.ForeignKey(
        AttendeeEnrollment, on_delete=models.CASCADE
    )
    facility_class_enrollment = models.ForeignKey(
        FacilityClassEnrollment, on_delete=models.CASCADE
    )

    def __str__(self):
        return f"{self.attendee_enrollment.attendee} - {self.facility_class_enrollment}"
