""" Faction Related Managers. """

from django.contrib.auth.models import BaseUserManager
from pages.managers import AbstractBaseManager
from .querysets import FactionQuerySet


class FactionManager(AbstractBaseManager):
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
        """
        Utilizes the custom `with_member_count` method from FactionQuerySet.
        """
        if include_descendants:
            return (
                self.get_queryset()
                .include_descendant_organizations()
                .with_member_count()
            )
        return self.get_queryset().with_member_count()

    def with_sub_faction_count(self):
        return self.get_queryset().with_sub_faction_count()
    
class AttendeeManager(BaseUserManager):
    """Attendee Manager."""

    def get_queryset(self, *args, **kwargs):
        """Get Queryset."""
        results = super().get_queryset(*args, **kwargs)
        return results.filter(role=User.Role.ATTENDEE)
    
class LeaderManager(BaseUserManager):
    """Leader Manager."""

    def get_queryset(self, *args, **kwargs):
        results = super().get_queryset(*args, **kwargs)
        return results.filter(role=User.Role.LEADER)