""" Faction Related QuerySets."""

from django.db import models
from django.db.models import Q

class FactionQuerySet(models.QuerySet):
    def active(self):
        return self.filter(is_active=True)

    def by_organization(self, organization_id):
        return self.filter(organization_id=organization_id)

    def by_faction(self, faction_id):
        return self.filter(parent_id=faction_id)

    def search(self, query):
        return self.filter(Q(name__icontains=query) | Q(description__icontains=query))

    def with_member_count(self, include_descendants=True):
        if include_descendants:
            return self.annotate(
                member_count=models.Count('attendeeprofile', distinct=True)
            )
        return self.annotate(
            member_count=models.Count('attendeeprofile', distinct=True)
        )

    def include_descendant_organizations(self):
        org_ids = set()
        for faction in self:
            org_ids.update(faction.organization.get_descendant_ids())
        return self.filter(organization__id__in=org_ids)

    def with_sub_faction_count(self):
        return self.annotate(sub_faction_count=models.Count('children', distinct=True))
