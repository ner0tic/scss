# faction/queryset/leader.py

from django.db import models


class LeaderQuerySet(models.QuerySet):
    def leaders(self):
        return self.filter(user_type='leader')

    def by_faction(self, faction):
        all_factions = [faction] + faction.get_all_children()
        return self.filter(leaderprofile__faction__in=all_factions)

    def by_organization(self, organization):
        all_organizations = [organization] + organization.get_all_children()
        return self.filter(leaderprofile__organization__in=all_organizations)
