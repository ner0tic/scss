""" Organization Enrollment Related Models. """

from django.db import models

from pages.mixins import models as mixins

from .temporal import AbstractTemporalHierarchy


class OrganizationEnrollment(AbstractTemporalHierarchy):  # AKA Season
    """Organization Enrollment Model."""

    organization = models.ForeignKey(
        "organization.Organization", on_delete=models.CASCADE
    )


class OrganizationCourse(mixins.NameDescriptionMixin, mixins.TimestampMixin, mixins.SoftDeleteMixin, mixins.AuditMixin, mixins.SlugMixin, mixins.ActiveMixin, models.Model):
    """Organization Course Model."""

    course = models.ForeignKey("course.Course", on_delete=models.CASCADE)
    organization_enrollment = models.ForeignKey(
        OrganizationEnrollment, on_delete=models.CASCADE
    )
