# faction/managers/leader.py

from django.db import models

from ..querysets.leader import LeaderQuerySet

    
class LeaderManager(models.Manager):
    """Leader Manager."""

    def get_queryset(self):
        return LeaderQuerySet(self.model, using=self._db)

    def leaders(self):
        return self.get_queryset().leaders()

    def by_faction(self, faction):
        return self.get_queryset().by_faction(faction)

    def by_organization(self, organization):
        return self.get_queryset().by_organization(organization)