""" Course Related Models. """

from django.db import models
from django.urls import reverse
from taggit.managers import TaggableManager

from pages.mixins import NameSlugMixin


class Requirement(NameSlugMixin, models.Model):
    """. Requirement Model."""

    name = models.CharField(max_length=100)
    description = models.TextField()

    def __str__(self):
        return self.name

    def get_absolute_url(self):
        return reverse(
            "requirement_show",
            kwargs={"course_slug": self.course.slug, "requirement_slug": self.slug},
        )


class Course(NameSlugMixin, models.Model):
    """Course Model."""

    name = models.CharField(max_length=100)
    description = models.TextField()
    requirements = models.ManyToManyField(
        Requirement, related_name="course", blank=True
    )
    prerequisites = models.ManyToManyField(
        "self", symmetrical=False, related_name="leads_to", blank=True
    )
    tags = TaggableManager()

    def __str__(self):
        return self.name

    def get_absolute_url(self):
        return reverse("course_show", kwargs={"course_slug": self.slug})
