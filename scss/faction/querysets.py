""" Faction Related QuerySets."""

from django.db import models
from django.db.models import Q


class FactionQuerySet(models.QuerySet):
    def active(self):
        """
        Returns factions that are currently active.
        """
        return self.filter(is_active=True)

    def by_organization(self, organization_id):
        """
        Returns factions belonging to a specific organization, including those
        of child organizations.
        """
        return self.filter(organization_id=organization_id)

    def search(self, query):
        """
        Performs a search across faction-related fields.
        """
        return self.filter(Q(name__icontains=query) | Q(description__icontains=query))

    def with_member_count(self):
        """
        Annotates factions with the count of their members.
        """
        return self.annotate(member_count=models.Count("members"))

    def include_descendant_organizations(self):
        """
        Extend the queryset to include factions from the organization's descendants.
        """
        org_ids = set()
        for faction in self:
            # Assuming a Faction model has a direct link to an Organization
            org_ids.update(faction.organization.get_descendant_ids())

        return self.filter(organization__id__in=org_ids)
