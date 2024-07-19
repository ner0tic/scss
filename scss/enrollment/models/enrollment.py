""" Enrollment Related Models. """

from django.contrib.auth import get_user_model
from django.db import models

from pages.mixins import models as mixins


User = get_user_model()


class ActiveEnrollment(models.Model):
    user = models.ForeignKey(
        User, on_delete=models.CASCADE, related_name="active_enrollments"
    )
    attendee_enrollment = models.ForeignKey(
        "AttendeeEnrollment",
        on_delete=models.SET_NULL,
        null=True,
        blank=True,
        related_name="+",
    )
    leader_enrollment = models.ForeignKey(
        "LeaderEnrollment",
        on_delete=models.SET_NULL,
        null=True,
        blank=True,
        related_name="+",
    )
    faction_enrollment = models.ForeignKey(
        "FactionEnrollment",
        on_delete=models.SET_NULL,
        null=True,
        blank=True,
        related_name="+",
    )
    faculty_enrollment = models.ForeignKey(
        "FacultyEnrollment",
        on_delete=models.SET_NULL,
        null=True,
        blank=True,
        related_name="+",
    )
    facility_enrollment = models.ForeignKey(
        "FacilityEnrollment",
        on_delete=models.SET_NULL,
        null=True,
        blank=True,
        related_name="+",
    )

    class Meta:
        # Ensures that there's only one active enrollment of any type per user
        unique_together = (
            ("user", "attendee_enrollment"),
            ("user", "leader_enrollment"),
            ("user", "faction_enrollment"),
            ("user", "faculty_enrollment"),
            ("user", "facility_enrollment"),
        )

    def __str__(self):
        return f"{self.user}'s Active Enrollment"
