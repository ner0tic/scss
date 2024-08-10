from django.db.models.signals import post_save, pre_save
from django.dispatch import receiver
from django.core.exceptions import ValidationError
from django.db import models
from django.urls import reverse
from django.utils import timezone

from pages.mixins import models as mixins
from .managers import OrganizationManager, OrganizationLabelsManager


class Organization(
    mixins.NameDescriptionMixin,
    mixins.TimestampMixin,
    mixins.SoftDeleteMixin,
    mixins.AuditMixin,
    mixins.SlugMixin,
    mixins.ActiveMixin,
    mixins.ParentChildMixin,
    mixins.ImageMixin,
    models.Model,
):
    """Organization Model."""

    abbreviation = models.CharField(max_length=25, null=True, blank=True)
    max_depth = models.PositiveIntegerField(default=0, blank=True)

    objects = OrganizationManager()

    def __str__(self):
        return f"{self.name}"

    def clean(self):
        # Check for depth
        depth = 0
        current = self
        while current.parent is not None:
            depth += 1
            if depth > self.max_depth:
                raise ValidationError("Maximum hierarchy depth exceeded")
            current = current.parent

    def save(self, *args, **kwargs):
        self.clean()
        super().save(*args, **kwargs)

    def get_total_factions_count(self):
        """
        Returns the total count of factions including the current organization and all its children.

        Returns:
            int: The total count of factions for the current organization and all its children.
        """

        total_count = self.factions.count()
        for child_org in self.children.all():
            total_count += child_org.get_total_factions_count()
        return total_count

    def get_descendant_ids(self):
        """
        Returns a list of ids including the current object and all its descendant ids.

        Returns:
            list: A list of integer ids representing the current object and all its descendants.
        """

        descendant_ids = [self.id]
        for child in self.children.all():
            descendant_ids.extend(child.get_descendant_ids())
        return descendant_ids

    def get_active_factions(self):
        """
        Returns active factions for the current organization.

        Returns:
            QuerySet: A queryset of active factions.
        """
        return self.factions.filter(is_active=True)

    def get_root_organization(self):
        if self.parent:
            return self.parent.get_root_organization()
        return self


class OrganizationLabels(models.Model):
    organization = models.OneToOneField(
        Organization, on_delete=models.CASCADE, related_name="labels"
    )
    attendee_label = models.CharField(max_length=50, default="Attendee")
    facility_label = models.CharField(max_length=50, default="Facility")
    faction_label = models.CharField(max_length=50, default="Faction")
    sub_faction_label = models.CharField(max_length=50, default="Sub-Faction")
    faculty_label = models.CharField(max_length=50, default="Faculty")
    leader_label = models.CharField(max_length=50, default="Leader")
    faculty_quarters_label = models.CharField(max_length=50, default="Faculty Quarters")
    faction_quarters_label = models.CharField(max_length=50, default="Faction Quarters")
    leader_quarters_label = models.CharField(max_length=50, default="Leader Quarters")
    attendee_quarters_label = models.CharField(
        max_length=50, default="Attendee Quarters"
    )
    course_label = models.CharField(max_length=50, default="Course")
    facility_enrollment_label = models.CharField(
        max_length=50, default="Facility Enrollment"
    )
    faction_enrollment_label = models.CharField(
        max_length=50, default="Faction Enrollment"
    )
    leader_enrollment_label = models.CharField(
        max_length=50, default="Leader Enrollment"
    )
    attendee_enrollment_label = models.CharField(
        max_length=50, default="Attendee Enrollment"
    )
    attendee_class_enrollment_label = models.CharField(
        max_length=50, default="Attendee Class Enrollment"
    )
    week_label = models.CharField(max_length=50, default="Week")
    period_label = models.CharField(max_length=50, default="Period")

    objects = OrganizationLabelsManager()

    def __str__(self):
        return f"Labels for {self.organization.name}"

    def update_labels(self, **kwargs):
        """
        Update the labels for the organization.

        Args:
            **kwargs: Key-value pairs of labels to update.
        """
        for key, value in kwargs.items():
            if hasattr(self, key):
                setattr(self, key, value)
        self.save()

    def add_default_labels(self):
        """
        Add default labels if they are not set.
        """
        default_labels = {
            "attendee_label": "Attendee",
            "facility_label": "Facility",
            "faction_label": "Faction",
            "sub_faction_label": "Sub-Faction",
            "faculty_label": "Faculty",
            "leader_label": "Leader",
            "faculty_quarters_label": "Faculty Quarters",
            "faction_quarters_label": "Faction Quarters",
            "leader_quarters_label": "Leader Quarters",
            "attendee_quarters_label": "Attendee Quarters",
            "course_label": "Course",
            "facility_enrollment_label": "Facility Enrollment",
            "faction_enrollment_label": "Faction Enrollment",
            "leader_enrollment_label": "Leader Enrollment",
            "attendee_enrollment_label": "Attendee Enrollment",
            "attendee_class_enrollment_label": "Attendee Class Enrollment",
            "week_label": "Week",
            "period_label": "Period",
        }

        for key, value in default_labels.items():
            if not getattr(self, key):
                setattr(self, key, value)
        self.save()


@receiver(post_save, sender=Organization)
def create_organization_labels(sender, instance, created, **kwargs):
    if created:
        OrganizationLabels.objects.create(organization=instance)


@receiver(post_save, sender=Organization)
def save_organization_labels(sender, instance, **kwargs):
    instance.labels.save()


class OrganizationSettings(models.Model):
    organization = models.OneToOneField(
        "Organization", on_delete=models.CASCADE, related_name="settings"
    )
    labels = models.OneToOneField(
        "OrganizationLabels", on_delete=models.CASCADE, related_name="settings"
    )
    max_depth = models.PositiveIntegerField(default=3)
    max_faction_depth = models.PositiveIntegerField(default=2)

    def __str__(self):
        return f"Settings for {self.organization.name}"
