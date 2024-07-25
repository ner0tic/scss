# faction/queryset/attendee.py

from django.db import models


class AttendeeQuerySet(models.QuerySet):
    def attendees(self):
        return self.filter(user_type='attendee')

    def by_faction(self, faction):
        all_factions = [faction] + faction.get_all_children()
        return self.filter(attendeeprofile__faction__in=all_factions)

    def by_organization(self, organization):
        all_organizations = [organization] + organization.get_all_children()
        return self.filter(attendeeprofile__organization__in=all_organizations)
