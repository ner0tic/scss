""" Enrollment Related Managers. """

from pages.managers import AbstractBaseManager
from .querysets import (
    FactionEnrollmentQuerySet,
    LeaderEnrollmentQuerySet,
    AttendeeEnrollmentQuerySet,
)


class LeaderEnrollmentManager(AbstractBaseManager):
    def get_queryset(self):
        return LeaderEnrollmentQuerySet(self.model, using=self.db)

    def by_faction_enrollment(self, faction_enrollment_id):
        return self.get_queryset().by_faction_enrollment(
            faction_enrollment_id=faction_enrollment_id
        )


class AttendeeEnrollmentManager(AbstractBaseManager):
    def get_queryset(self):
        return AttendeeEnrollmentQuerySet(self.model, using=self.db)

    def by_faction_enrollment(self, faction_enrollment_id):
        return self.get_queryset().by_faction_enrollment(faction_enrollment_id)


class FactionEnrollmentManager(AbstractBaseManager):
    def get_queryset(self):
        """
        Returns the custom queryset for factions.
        """
        return FactionEnrollmentQuerySet(self.model, using=self._db)

    def active(self):
        """
        Utilizes the custom `active` method from FactionQuerySet.
        """
        return self.get_queryset().active()

    def by_faction(self, faction_id):
        """
        Utilizes the custom `by_organization` method from FactionQuerySet.
        """
        return self.get_queryset().by_faction(faction_id)
