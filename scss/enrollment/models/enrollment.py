# enrollment/models/enrollment.py
"""Enrollment Related Models."""

from django.contrib.auth import get_user_model
from django.db import models
from django.core.exceptions import ValidationError

from pages.mixins import models as mixins

User = get_user_model()


class ActiveEnrollment(models.Model):
    """Model to track the active enrollment of a user in various roles."""

    user = models.ForeignKey(
        User,
        on_delete=models.CASCADE,
        related_name="active_enrollments",
        verbose_name="User",
    )
    attendee_enrollment = models.ForeignKey(
        "AttendeeEnrollment",
        on_delete=models.SET_NULL,
        null=True,
        blank=True,
        related_name="active_attendee_enrollments",
        verbose_name="Attendee Enrollment",
    )
    leader_enrollment = models.ForeignKey(
        "LeaderEnrollment",
        on_delete=models.SET_NULL,
        null=True,
        blank=True,
        related_name="active_leader_enrollments",
        verbose_name="Leader Enrollment",
    )
    faction_enrollment = models.ForeignKey(
        "FactionEnrollment",
        on_delete=models.SET_NULL,
        null=True,
        blank=True,
        related_name="active_faction_enrollments",
        verbose_name="Faction Enrollment",
    )
    faculty_enrollment = models.ForeignKey(
        "FacultyEnrollment",
        on_delete=models.SET_NULL,
        null=True,
        blank=True,
        related_name="active_faculty_enrollments",
        verbose_name="Faculty Enrollment",
    )
    facility_enrollment = models.ForeignKey(
        "FacilityEnrollment",
        on_delete=models.SET_NULL,
        null=True,
        blank=True,
        related_name="active_facility_enrollments",
        verbose_name="Facility Enrollment",
    )

    class Meta:
        """Metadata."""

        verbose_name = "Active Enrollment"
        verbose_name_plural = "Active Enrollments"
        # Ensures that there's only one active enrollment of any type per user
        constraints = [
            models.UniqueConstraint(
                fields=["user", "attendee_enrollment"],
                name="unique_active_attendee_enrollment",
            ),
            models.UniqueConstraint(
                fields=["user", "leader_enrollment"],
                name="unique_active_leader_enrollment",
            ),
            models.UniqueConstraint(
                fields=["user", "faction_enrollment"],
                name="unique_active_faction_enrollment",
            ),
            models.UniqueConstraint(
                fields=["user", "faculty_enrollment"],
                name="unique_active_faculty_enrollment",
            ),
            models.UniqueConstraint(
                fields=["user", "facility_enrollment"],
                name="unique_active_facility_enrollment",
            ),
        ]

    def __str__(self):
        """String representation."""
        return f"{self.user}'s Active Enrollment"

    def clean(self):
        """Ensure only one enrollment type is set for a user."""
        super().clean()
        enrollments = [
            self.attendee_enrollment,
            self.leader_enrollment,
            self.faction_enrollment,
            self.faculty_enrollment,
            self.facility_enrollment,
        ]
        if sum(bool(enrollment) for enrollment in enrollments) > 1:
            raise ValidationError(
                "Only one type of active enrollment can be set per user."
            )

    def get_active_enrollment(self):
        """Return the active enrollment for the user."""
        return (
            self.attendee_enrollment
            or self.leader_enrollment
            or self.faction_enrollment
            or self.faculty_enrollment
            or self.facility_enrollment
        )

    def has_active_enrollment(self):
        """Check if the user has any active enrollment."""
        return self.get_active_enrollment() is not None
