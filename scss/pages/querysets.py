""" Base QuerySets. """
from django.db import models


class AbstractBaseQuerySet(models.QuerySet):
    def search(self, query):
        """
        Performs a search across faction-related fields.
        """
        return self.filter(
            models.Q(name__icontains=query) | models.Q(description__icontains=query)
        )
