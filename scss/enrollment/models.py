""" Enrollment Related Models. """
from django.db import models
from django.conf import settings
from pages.mixins import NameSlugMixin


class AbstractTemporalHierarchy(NameSlugMixin, models.Model):
    """Abstract Temporal Hierarchy Model."""

    name = models.CharField(max_length=100)
    description = models.TextField()
    start_timestamp = models.DateTimeField()
    end_timestamp = models.DateTimeField()

    class Meta:
        """Metadata."""

        abstract = True

    def __str__(self):
        return self.name


class OrganizationEnrollment(AbstractTemporalHierarchy):  # AKA Season
    """Organization Enrollment Model."""

    organization = models.ForeignKey(
        "organization.Organization", on_delete=models.CASCADE
    )

    def __str__(self):
        return f"[{self.organization.abbreviation}] {self.name}"


class FacilityEnrollment(AbstractTemporalHierarchy):
    """Facility Enrollment Model."""

    organization_enrollment = models.ForeignKey(
        OrganizationEnrollment, on_delete=models.CASCADE
    )
    facility = models.ForeignKey("facility.Facility", on_delete=models.CASCADE)

    def __str__(self):
        return f"{self.facility.name} - {self.name}"


class FactionEnrollment(models.Model):
    """Faction Enrollment Model."""

    faction = models.ForeignKey("faction.Faction", on_delete=models.CASCADE)
    facility_enrollment = models.ForeignKey(
        FacilityEnrollment, on_delete=models.CASCADE
    )
    quarters = models.ForeignKey("facility.Quarters", on_delete=models.CASCADE)

    def __str__(self):
        return f"{self.faction.abbreviation} @ {self.facility_enrollment}"


class LeaderEnrollment(models.Model):
    """Leader Enrollment Model."""

    faction_enrollment = models.ForeignKey(FactionEnrollment, on_delete=models.CASCADE)
    leader = models.ForeignKey("faction.Leader", on_delete=models.CASCADE)

    def __str__(self):
        return f"{self.leader} - {self.faction_enrollment}"


class Week(AbstractTemporalHierarchy):
    """Week Model."""

    facility_enrollment = models.ForeignKey(
        FacilityEnrollment, on_delete=models.CASCADE
    )

    def __str__(self):
        return f"{self.facility_enrollment} {self.name}"


class Period(AbstractTemporalHierarchy):
    """Period Model."""

    week = models.ForeignKey(Week, on_delete=models.CASCADE)


class OrganizationCourse(models.Model):
    """Organization Course Model."""

    course = models.ForeignKey("course.Course", on_delete=models.CASCADE)
    organization_enrollment = models.ForeignKey(
        OrganizationEnrollment, on_delete=models.CASCADE
    )

    def __str__(self):
        return f"{self.course.name} - {self.organization_enrollment}"


class FacilityClass(models.Model):
    """Facility Class Model."""

    organization_course = models.ForeignKey(
        OrganizationCourse, on_delete=models.CASCADE
    )
    facility_enrollment = models.ForeignKey(
        FacilityEnrollment, on_delete=models.CASCADE
    )

    def __str__(self):
        return f"{self.organization_course.__str__()} @ {self.facility_enrollment}"


class FacilityClassEnrollment(models.Model):
    """Facility Class Enrollment Model."""

    facility_class = models.ForeignKey(FacilityClass, on_delete=models.CASCADE)
    period = models.ForeignKey(Period, on_delete=models.CASCADE)
    department = models.ForeignKey("facility.Department", on_delete=models.CASCADE)
    # faculty[]

    def __str__(self):
        return f"{self.period} - {self.facility_class} @ {self.department}"


class AttendeeEnrollment(models.Model):
    """Attendee Enrollment Model."""

    attendee = models.ForeignKey("faction.Attendee", on_delete=models.CASCADE)
    faction_enrollment = models.ForeignKey(FactionEnrollment, on_delete=models.CASCADE)
    quarters = models.ForeignKey("facility.Quarters", on_delete=models.CASCADE)

    def __str__(self):
        return f"{self.attendee} - {self.faction_enrollment} - {self.quarters}"


class AttendeeClassEnrollment(models.Model):
    """Attendee Class Enrollment Model."""

    attendee_enrollment = models.ForeignKey(
        AttendeeEnrollment, on_delete=models.CASCADE
    )
    facility_class_enrollment = models.ForeignKey(
        FacilityClassEnrollment, on_delete=models.CASCADE
    )

    def __str__(self):
        return f"{self.attendee_enrollment.attendee} - {self.facility_class_enrollment}"


class FacultyClassEnrollment(models.Model):
    """Faculty Class Enrollment Model."""

    faculty = models.ForeignKey("facility.Faculty", on_delete=models.CASCADE)
    facility_class_enrollment = models.ForeignKey(
        FacilityClassEnrollment, on_delete=models.CASCADE
    )

    def __str__(self):
        return f"{self.faculty} - {self.facility_class_enrollment}"


class ActiveEnrollment(models.Model):
    """Active Enrollment Model."""

    user = models.ForeignKey(
        settings.AUTH_USER_MODEL,
        on_delete=models.CASCADE
    )
    faction_enrollment = models.ForeignKey(
        FactionEnrollment,
        on_delete=models.SET_NULL,
        null=True,
        blank=True
    )
    facility_enrollment = models.ForeignKey(
        FacilityEnrollment,
        on_delete=models.SET_NULL,
        null=True,
        blank=True
    )

    def __str__(self):
        return f"{self.user.username}'s active enrollment"
