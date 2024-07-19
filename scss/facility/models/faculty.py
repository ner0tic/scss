""" Faculty Related Models. """

from django.contrib.contenttypes.fields import GenericRelation
from django.db import models
from django.db.models.signals import post_save
from django.dispatch import receiver
from django.forms import ValidationError
from django.urls import reverse

from pages.mixins import models as mixins
from user.models import User, UserProfile
from address.models import Address
from organization.models import Organization

from .facility import Facility
from ..managers import FacultyManager

class Faculty(mixins.SlugMixin, mixins.TimestampMixin, mixins.SoftDeleteMixin, mixins.AuditMixin, mixins.ImageMixin, User):
    role = User.Role.FACULTY
    facility = models.ForeignKey(
        Facility,
        on_delete=models.CASCADE,
        null=True,
        blank=True,
        related_name="faculty",
    )
    organization = models.ForeignKey(
        Organization,
        on_delete=models.CASCADE,
        null=True,
        blank=True,
        related_name="faculty",
    )
    address = GenericRelation(Address, null=True, blank=True)

    faculty = FacultyManager()

    class Meta:
        # proxy = True
        verbose_name = 'Faculty'
        verbose_name_plural = 'Faculty'

    def welcome(self):
        return "Only for faculty"

    def get_absolute_url(self):
        return reverse("faculty_show", kwargs={"faculty_slug": self.slug})


class FacultyProfile(UserProfile):
    organization = models.ForeignKey(Organization, on_delete=models.SET_NULL, null=True, blank=True)
    facility = models.ForeignKey(Facility, on_delete=models.SET_NULL, null=True, blank=True)


@receiver(post_save, sender=Faculty)
def create_user_profile(sender, instance, created, **kwargs):
    if created and instance.role == "FACULTY":
        FacultyProfile.objects.create(user=instance)
