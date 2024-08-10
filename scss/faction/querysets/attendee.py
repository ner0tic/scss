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

    def for_faction(self, faction):
        # Get the list of all sub-factions
        sub_factions = self._get_all_sub_factions(faction)
        
        # Include the original faction
        factions = [faction.id] + [f.id for f in sub_factions]
        
        return self.filter(faction_id__in=factions)

    def _get_all_sub_factions(self, faction):
        sub_factions = []
        for sub_faction in faction.children.all():
            sub_factions.append(sub_faction)
            sub_factions.extend(self._get_all_sub_factions(sub_faction))
        return sub_factions