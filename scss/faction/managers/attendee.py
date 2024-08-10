# faction/managers/attendee.py

from django.db import models

from ..querysets.attendee import AttendeeQuerySet


class AttendeeManager(models.Manager):
    def get_queryset(self):
        return AttendeeQuerySet(self.model, using=self._db)

    def attendees(self):
        return self.get_queryset().attendees()

    def by_faction(self, faction):
        return self.get_queryset().by_faction(faction)

    def by_organization(self, organization):
        return self.get_queryset().by_organization(organization)

    def for_faction(self, faction):
        return self.get_queryset().for_faction(faction)