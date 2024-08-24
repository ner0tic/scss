# enrollment/models/organization.py
"""Organization Enrollment Related Models."""

from django.db import models
from django.core.exceptions import ValidationError

from pages.mixins import models as mixins

from .temporal import AbstractTemporalHierarchy


class OrganizationEnrollment(AbstractTemporalHierarchy):
    """Organization Enrollment Model.

    Represents a specific enrollment period (e.g., a season) for an organization.
    """

    organization = models.ForeignKey(
        "organization.Organization",
        on_delete=models.CASCADE,
        related_name="enrollments",
        verbose_name="Organization",
    )

    class Meta:
        """Metadata."""

        verbose_name = "Organization Enrollment"
        verbose_name_plural = "Organization Enrollments"
        ordering = ["start"]

    def __str__(self):
        """String representation."""
        return f"{self.organization.name} Enrollment ({self.start} - {self.end})"

    def clean(self):
        """Custom validation logic."""
        super().clean()
        if self.start and self.end and self.start > self.end:
            raise ValidationError("The start date cannot be later than the end date.")

    def get_courses(self):
        """Return all courses associated with this enrollment."""
        return self.organizationcourse_set.all()


class OrganizationCourse(
    mixins.NameDescriptionMixin,
    mixins.TimestampMixin,
    mixins.SoftDeleteMixin,
    mixins.AuditMixin,
    mixins.SlugMixin,
    mixins.ActiveMixin,
    models.Model,
):
    """Organization Course Model.

    Represents a specific course offered during an organization enrollment period.
    """

    course = models.ForeignKey(
        "course.Course",
        on_delete=models.CASCADE,
        related_name="organization_courses",
        verbose_name="Course",
    )
    organization_enrollment = models.ForeignKey(
        OrganizationEnrollment,
        on_delete=models.CASCADE,
        related_name="courses",
        verbose_name="Organization Enrollment",
    )

    class Meta:
        """Metadata."""

        verbose_name = "Organization Course"
        verbose_name_plural = "Organization Courses"
        ordering = ["name"]

    def __str__(self):
        """String representation."""
        return f"{self.course.name} during {self.organization_enrollment}"

    def clean(self):
        """Custom validation logic."""
        super().clean()
        # Ensure the course is active and the enrollment period is valid
        if not self.course.is_active:
            raise ValidationError(f"The course {self.course.name} is not active.")
