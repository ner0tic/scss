# enrollment/models/facility.py
"""Facility Enrollment Related Models."""

from django.db import models
from django.core.exceptions import ValidationError

from pages.mixins import models as mixins

from .temporal import AbstractTemporalHierarchy, Period
from .organization import OrganizationEnrollment, OrganizationCourse


class FacilityEnrollment(AbstractTemporalHierarchy):
    """Facility Enrollment Model.

    Represents the enrollment period of a facility in an organization.
    """

    organization_enrollment = models.ForeignKey(
        OrganizationEnrollment,
        on_delete=models.CASCADE,
        related_name="facility_enrollments",
        verbose_name="Organization Enrollment",
    )
    facility = models.ForeignKey(
        "facility.Facility",
        on_delete=models.CASCADE,
        related_name="enrollments",
        verbose_name="Facility",
    )

    class Meta:
        """Metadata."""

        verbose_name = "Facility Enrollment"
        verbose_name_plural = "Facility Enrollments"
        ordering = ["start"]

    def __str__(self):
        """String representation."""
        return f"{self.facility.name} Enrollment ({self.start} - {self.end})"

    def clean(self):
        """Ensure that the facility enrollment period is within the organization enrollment period."""
        super().clean()
        if self.start and self.end:
            org_enroll = self.organization_enrollment
            if self.start < org_enroll.start or self.end > org_enroll.end:
                raise ValidationError(
                    "Facility enrollment period must be within the organization enrollment period."
                )


class FacilityClass(
    mixins.NameDescriptionMixin,
    mixins.TimestampMixin,
    mixins.SoftDeleteMixin,
    mixins.AuditMixin,
    mixins.SlugMixin,
    mixins.ActiveMixin,
    models.Model,
):
    """Facility Class Model.

    Represents a class offered at a facility during a specific enrollment period.
    """

    organization_course = models.ForeignKey(
        OrganizationCourse,
        on_delete=models.CASCADE,
        related_name="facility_classes",
        verbose_name="Organization Course",
    )
    facility_enrollment = models.ForeignKey(
        FacilityEnrollment,
        on_delete=models.CASCADE,
        related_name="facility_classes",
        verbose_name="Facility Enrollment",
    )

    class Meta:
        """Metadata."""

        verbose_name = "Facility Class"
        verbose_name_plural = "Facility Classes"
        ordering = ["name"]

    def __str__(self):
        """String representation."""
        return f"{self.name} ({self.organization_course.course.name} at {self.facility_enrollment.facility.name})"


class FacilityClassEnrollment(
    mixins.NameDescriptionMixin,
    mixins.TimestampMixin,
    mixins.SoftDeleteMixin,
    mixins.AuditMixin,
    mixins.SlugMixin,
    mixins.ActiveMixin,
    models.Model,
):
    """Facility Class Enrollment Model."""

    facility_class = models.ForeignKey(FacilityClass, on_delete=models.CASCADE)
    period = models.ForeignKey(Period, on_delete=models.CASCADE)
    department = models.ForeignKey("facility.Department", on_delete=models.CASCADE)
    # Adding ForeignKey to OrganizationEnrollment
    organization_enrollment = models.ForeignKey(
        OrganizationEnrollment, on_delete=models.CASCADE
    )

    def __str__(self):
        return f"{self.facility_class} - {self.period} - {self.department}"

    class Meta:
        """Metadata."""

        verbose_name = "Facility Class Enrollment"
        verbose_name_plural = "Facility Class Enrollments"
        ordering = ["facility_class__name", "period__start"]


class FacultyEnrollment(models.Model):
    """Faculty Enrollment Model.

    Represents the enrollment of faculty in a specific facility during a period.
    """

    faculty = models.ForeignKey(
        "facility.Faculty",
        on_delete=models.CASCADE,
        related_name="enrollments",
        verbose_name="Faculty",
    )
    facility_enrollment = models.ForeignKey(
        FacilityEnrollment,
        on_delete=models.CASCADE,
        related_name="faculty_enrollments",
        verbose_name="Facility Enrollment",
    )
    quarters = models.ForeignKey(
        "facility.Quarters",
        on_delete=models.CASCADE,
        related_name="faculty_enrollments",
        verbose_name="Quarters",
    )

    class Meta:
        """Metadata."""

        verbose_name = "Faculty Enrollment"
        verbose_name_plural = "Faculty Enrollments"
        ordering = ["faculty__last_name", "faculty__first_name"]

    def __str__(self):
        """String representation."""
        return f"{self.faculty} - {self.facility_enrollment.facility.name}"


class FacultyClassEnrollment(models.Model):
    """Faculty Class Enrollment Model.

    Represents the enrollment of faculty in a specific class at a facility.
    """

    faculty = models.ForeignKey(
        "facility.Faculty",
        on_delete=models.CASCADE,
        related_name="class_enrollments",
        verbose_name="Faculty",
    )
    facility_class_enrollment = models.ForeignKey(
        FacilityClassEnrollment,
        on_delete=models.CASCADE,
        related_name="faculty_class_enrollments",
        null=True,
        blank=True,
        verbose_name="Facility Class Enrollment",
    )
    faculty_enrollment = models.ForeignKey(
        FacultyEnrollment,
        on_delete=models.CASCADE,
        related_name="class_enrollments",
        null=True,
        blank=True,
        verbose_name="Faculty Enrollment",
    )

    class Meta:
        """Metadata."""

        verbose_name = "Faculty Class Enrollment"
        verbose_name_plural = "Faculty Class Enrollments"
        ordering = ["faculty__last_name", "faculty__first_name"]

    def __str__(self):
        """String representation."""
        return f"{self.faculty} - {self.facility_class_enrollment}"
