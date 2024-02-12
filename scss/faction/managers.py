""" Faction Related Managers. """
from django.db import models

from .querysets import FactionQuerySet

class FactionManager(models.Manager):
    def get_queryset(self):
        """
        Returns the custom queryset for factions.
        """
        return FactionQuerySet(self.model, using=self._db)

    def active(self):
        """
        Utilizes the custom `active` method from FactionQuerySet.
        """
        return self.get_queryset().active()

    def by_organization(self, organization_id):
        """
        Utilizes the custom `by_organization` method from FactionQuerySet.
        """
        return self.get_queryset().by_organization(organization_id)

    def search(self, query):
        """
        Utilizes the custom `search` method from FactionQuerySet.
        """
        return self.get_queryset().search(query)

    def with_member_count(self, include_descendants=True):
        """
        Utilizes the custom `with_member_count` method from FactionQuerySet.
        """
        if include_descendants:
            return self.get_queryset().include_descendant_organizations().with_member_count()
        return self.get_queryset().with_member_count()
