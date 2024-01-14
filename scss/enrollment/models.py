from django.db import models

class AbstractTemporalHierarchy(models.Model):
    name = models.CharField(max_length=100)
    description = models.TextField()
    start_timestamp = models.DateTimeField()
    end_timestamp = models.DateTimeField()

    class Meta:
        abstract = True


class OrganizationEnrollment(AbstractTemporalHierarchy): # AKA Season
    """ Organization Enrollment Model. """
    organization = models.ForeignKey('organization.Organization', on_delete=models.CASCADE)


class FacilityEnrollment(models.Model):
    organization_enrollment = models.ForeignKey(OrganizationEnrollment, on_delete=models.CASCADE)
    facility = models.ForeignKey('facility.Facility', on_delete=models.CASCADE)


class FactionEnrollment(models.Model):
    facility_enrollment = models.ForeignKey(FacilityEnrollment, on_delete=models.CASCADE)
    quarters = models.ForeignKey('facility.Quarters', on_delete=models.CASCADE)


class Week(AbstractTemporalHierarchy):
    facility_enrollment = models.ForeignKey(FacilityEnrollment, on_delete=models.CASCADE)


class Period(AbstractTemporalHierarchy):
    week = models.ForeignKey(Week, on_delete=models.CASCADE)


class FacilityClass(models.Model):
    course = models.ForeignKey('course.Course', on_delete=models.CASCADE)
    organization_enrollment = models.ForeignKey('OrganizationEnrollment', on_delete=models.CASCADE)


class AttendeeEnrollment(models.Model):
    attendee = models.ForeignKey('faction.Attendee', on_delete=models.CASCADE)
    faction_enrollment = models.ForeignKey(FactionEnrollment, on_delete=models.CASCADE)
    quarters = models.ForeignKey('facility.Quarters', on_delete=models.CASCADE)


class FacilityClassEnrollment(models.Model):
    facility_class = models.ForeignKey(FacilityClass, on_delete=models.CASCADE)
    facility_enrollment = models.ForeignKey(FacilityEnrollment, on_delete=models.CASCADE)


class AttendeeClassEnrollment(models.Model):
    attendee_enrollment = models.ForeignKey(AttendeeEnrollment, on_delete=models.CASCADE)
    facility_class_enrollment = models.ForeignKey(FacilityClassEnrollment, on_delete=models.CASCADE)
