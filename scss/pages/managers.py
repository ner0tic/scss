""" Base Managers. """

from django.db import models
from .querysets import AbstractBaseQuerySet


class AbstractBaseManager(models.Manager):
    """
    A base manager for models.

    This manager provides additional methods for querying and searching models.

    Methods:
        get_queryset() -> BaseQuerySet: Returns the base queryset for the manager.
        get_or_none(**kwargs) -> Model or None: Returns an instance of the model matching the given kwargs, or None if not found.
        get_or_create(**kwargs) -> Tuple[Model, bool]: Returns an instance of the model matching the given kwargs, and a boolean indicating if it was created.
        search(query: str) -> QuerySet: Searches the queryset for a given query.

    Args:
        self: The instance of the manager.

    Returns:
        BaseQuerySet: The base queryset for the manager.

    Raises:
        DoesNotExist: If the model instance does not exist.

    Example:
        >>> manager = BaseManager()
        >>> manager.get_or_none(id=1)
        <Page: Page object (1)>
    """

    def get_queryset(self):
        """
        Returns the base queryset for the manager.

        Args:
            self: The instance of the manager.

        Returns:
            BaseQuerySet: The base queryset for the manager.
        """

        return AbstractBaseQuerySet(self.model, using=self._db)

    def get_or_none(self, **kwargs):
        """
        Returns an instance of the model matching the given kwargs, or None if not found.

        Args:
            self: The instance of the manager.
            **kwargs: Keyword arguments used to filter the model.

        Returns:
            Model or None: The instance of the model matching the given kwargs, or None if not found.
        """

        try:
            return self.get(**kwargs)
        except self.model.DoesNotExist:
            return None

    def get_or_create(self, **kwargs):
        """
        Returns an instance of the model matching the given kwargs, and a boolean indicating if it was created.

        Args:
            self: The instance of the manager.
            **kwargs: Keyword arguments used to filter the model.

        Returns:
            Tuple[Model, bool]: A tuple containing the instance of the model matching the given kwargs, and a boolean indicating if it was created.
        """

        try:
            return self.get(**kwargs), False
        except self.model.DoesNotExist:
            return self.create(**kwargs), True

    def search(self, query):
        """
        Searches the queryset for a given query.

        Args:
            self: The instance of the manager.
            query (str): The search query.

        Returns:
            QuerySet: The filtered queryset.
        """

        return self.get_queryset().search(query)
