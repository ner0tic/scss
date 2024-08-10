# faction/managers/faction.py

from pages.managers import AbstractBaseManager

from ..querysets.faction import FactionQuerySet


class FactionManager(AbstractBaseManager):
    """ Faction Manager. """

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

    def by_faction(self, faction_id):
        return self.get_queryset().by_faction(faction_id)

    def with_member_count(self, include_descendants=True):
        return self.get_queryset().with_member_count(include_descendants)

    def with_sub_faction_count(self):
        return self.get_queryset().with_sub_faction_count()
