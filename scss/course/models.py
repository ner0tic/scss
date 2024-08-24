# course/models.py
""" Course Related Models. """

from django.db import models
from django.urls import reverse
from taggit.managers import TaggableManager

from pages.mixins import models as mixins


class Requirement(mixins.NameDescriptionMixin, mixins.TimestampMixin, mixins.SoftDeleteMixin, mixins.AuditMixin, mixins.SlugMixin, mixins.ActiveMixin, mixins.ImageMixin, models.Model):
    """. Requirement Model."""

    def __str__(self):
        return self.name

    def get_absolute_url(self):
        return reverse(
            "requirement_show",
            kwargs={"course_slug": self.course.slug, "requirement_slug": self.slug},
        )


class Course(mixins.NameDescriptionMixin, mixins.TimestampMixin, mixins.SoftDeleteMixin, mixins.AuditMixin, mixins.SlugMixin, mixins.ActiveMixin, mixins.ImageMixin, mixins.ParentChildMixin, models.Model):
    """Course Model."""

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
