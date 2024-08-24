# organization/managers/organization.py

from django.db import models

from ..querysets.organization import OrganizationQuerySet, OrganizationLabelsQuerySet

class OrganizationManager(models.Manager):
    """
    A custom manager for the Organization model.

    Provides additional methods for querying organizations.

    Methods:
        get_queryset(): Returns a QuerySet for the Organization model.
        top_level(): Returns a QuerySet containing only the top-level organizations.
        has_factions(): Returns a QuerySet containing organizations that have factions.
    """

    def get_queryset(self):
        """
        Returns a QuerySet for the Organization model.

        Returns:
            QuerySet: A QuerySet for the Organization model.
        """

        return OrganizationQuerySet(self.model, using=self._db)

    def top_level(self):
        """
        Returns a QuerySet containing only the top-level organizations.

        Returns:
            QuerySet: A QuerySet containing only the top-level organizations.
        """

        return self.get_queryset().top_level()

    def has_factions(self):
        """
        Returns a QuerySet containing organizations that have factions.

        Returns:
            QuerySet: A QuerySet containing organizations that have at least one faction associated with them.
        """

        return self.get_queryset().has_factions()

    def has_facilities(self):
        """
        Returns a QuerySet containing organizations that have facilities.

        Returns:
            QuerySet: A QuerySet containing organizations that have at least one facility associated with them.
        """

        return self.get_queryset().has_facilities()

    def __getattr__(self, attr, *args):
        """
        Overrides the default behavior for attribute access.

        This method is called when an attribute is accessed on the OrganizationManager instance.
        It delegates the attribute access to the underlying QuerySet instance obtained from get_queryset().

        Args:
            attr (str): The name of the attribute being accessed.
            *args: Additional arguments passed to the attribute access.

        Returns:
            Any: The result of the attribute access on the underlying QuerySet instance.

        Raises:
            AttributeError: If the attribute starts with an underscore.
        """

        if attr.startswith("_"):
            raise AttributeError
        return getattr(self.get_queryset(), attr, *args)

    def active(self):
        """
        Returns a QuerySet containing active organizations.

        Returns:
            QuerySet: A QuerySet containing organizations that are considered active.
        """
        return self.get_queryset().active()

    def search_by_name(self, name):
        """
        Returns a QuerySet containing organizations that match the given name.

        Args:
            name (str): The name to search for.

        Returns:
            QuerySet: A QuerySet containing organizations that match the given name.
        """
        return self.get_queryset().search_by_name(name)

    def children_of(self, parent_id):
        """
        Returns a QuerySet containing the children organizations of the specified parent organization.

        Args:
            parent_id (int): The ID of the parent organization.

        Returns:
            QuerySet: A QuerySet containing the children organizations of the specified parent organization.
        """
        return self.get_queryset().children_of(parent_id)

    def with_total_factions_count(self):
        return self.get_queryset().with_total_factions_count()

class OrganizationLabelsManager(models.Manager):
    def get_queryset(self):
        return OrganizationLabelsQuerySet(self.model, using=self._db)