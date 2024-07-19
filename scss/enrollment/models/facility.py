""" Facility Enrollment Related Models. """

from django.db import models

from pages.mixins import models as mixins

from .temporal import AbstractTemporalHierarchy, Period
from .organization import OrganizationEnrollment, OrganizationCourse


class FacilityEnrollment(AbstractTemporalHierarchy):
    """Facility Enrollment Model."""

    organization_enrollment = models.ForeignKey(
        OrganizationEnrollment, on_delete=models.CASCADE
    )
    facility = models.ForeignKey(
        "facility.Facility", on_delete=models.CASCADE, related_name="enrollments"
    )


class FacilityClass(mixins.NameDescriptionMixin, mixins.TimestampMixin, mixins.SoftDeleteMixin, mixins.AuditMixin, mixins.SlugMixin, mixins.ActiveMixin, models.Model):
    """Facility Class Model."""

    organization_course = models.ForeignKey(
        OrganizationCourse, on_delete=models.CASCADE
    )
    facility_enrollment = models.ForeignKey(
        FacilityEnrollment, on_delete=models.CASCADE
    )

class FacilityClassEnrollment(mixins.NameDescriptionMixin, mixins.TimestampMixin, mixins.SoftDeleteMixin, mixins.AuditMixin, mixins.SlugMixin, mixins.ActiveMixin, models.Model):
    """Facility Class Enrollment Model."""

    facility_class = models.ForeignKey(FacilityClass, on_delete=models.CASCADE)
    period = models.ForeignKey(Period, on_delete=models.CASCADE)
    department = models.ForeignKey("facility.Department", on_delete=models.CASCADE)
    # faculty = models.ForeignKey("facility.Faculty", on_delete=models.CASCADE)


class FacultyEnrollment(models.Model):
    """Faculty Enrollment Model."""

    faculty = models.ForeignKey("facility.Faculty", on_delete=models.CASCADE)
    facility_enrollment = models.ForeignKey(
        "enrollment.FacilityEnrollment", on_delete=models.CASCADE
    )
    quarters = models.ForeignKey("facility.Quarters", on_delete=models.CASCADE)
    faculty_class_enrollments = models.ForeignKey(
        "enrollment.FacultyClassEnrollment",
        on_delete=models.CASCADE,
        null=True,
        blank=True,
    )


class FacultyClassEnrollment(models.Model):
    """Faculty Class Enrollment Model."""

    faculty = models.ForeignKey("facility.Faculty", on_delete=models.CASCADE)
    facility_class_enrollment = models.ForeignKey(
        FacilityClassEnrollment, on_delete=models.CASCADE, null=True, blank=True
    )
    faculty_enrollment = models.ForeignKey(
        FacultyEnrollment, on_delete=models.CASCADE, null=True, blank=True
    )

    def __str__(self):
        return f"{self.faculty} - {self.facility_class_enrollment}"
