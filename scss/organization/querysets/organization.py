# organization/querysets/organization.py

from django.db import models

from faction.models.faction import Faction


class OrganizationLabelsQuerySet(models.QuerySet):
    pass


class OrganizationQuerySet(models.QuerySet):
    """
    A custom QuerySet for the Organization model.

    Provides additional methods for querying organizations.

    Methods:
        top_level(): Returns a QuerySet containing only the top-level organizations.
        has_factions(): Returns a QuerySet containing organizations that have factions.
    """

    def top_level(self):
        """
        Returns a QuerySet containing only the top-level organizations.

        Returns:
            QuerySet: A QuerySet containing the top-level organizations, i.e., organizations that do not have a parent organization.
        """

        return self.filter(parent__isnull=True)

    def has_factions(self):
        """
        Returns a QuerySet containing organizations that have factions.

        Returns:
            QuerySet: A QuerySet containing organizations that have at least one faction associated with them.
        """

        return self.filter(factions__is_notnull=True).distinct()

    def active(self):
        return self.filter(is_active=True)

    def search_by_name(self, name):
        return self.filter(name__icontains=name)

    def children_of(self, parent_id):
        return self.filter(parent__id=parent_id)

    def with_all_factions(self):
        """
        This method returns a queryset of organizations with all their factions,
        including those from child organizations.
        """

        def get_descendants_ids(org):
            descendants = [org.id]
            for child in org.children.all():
                descendants.extend(get_descendants_ids(child))
            return descendants

        # Generate Q objects for filtering factions based on organization hierarchy
        q_objects = models.ManyToManyFieldQ()
        for org in self:
            descendant_ids = get_descendants_ids(org)
            q_objects |= models.Q(organization_id__in=descendant_ids)

        return Faction.objects.filter(q_objects).distinct()
