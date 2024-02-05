""" Course Related Models. """
from django.db import models

from pages.mixins import NameSlugMixin


class Requirement(NameSlugMixin, models.Model):
    """. Requirement Model."""

    name = models.CharField(max_length=100)
    description = models.TextField()

    def __str__(self):
        return self.name


class Course(NameSlugMixin, models.Model):
    """Course Model."""

    name = models.CharField(max_length=100)
    description = models.TextField()
    requirements = models.ManyToManyField(
        Requirement, related_name="courses_as_requirement", blank=True
    )
    # prerequisites = models.ManyToManyField(Requirement, related_name='courses_as_prerequisite')

    def __str__(self):
        return self.name
