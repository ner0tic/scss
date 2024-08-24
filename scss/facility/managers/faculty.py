# facility/managers/faculty.py

from django.db import models

from ..querysets.faculty import FacultyQuerySet


class FacultyManager(models.Manager):
    """Faculty Manager."""

    def get_queryset(self):
        return FacultyQuerySet(self.model, using=self._db)

    def by_facility(self, facility):
        return self.get_queryset().by_facility(facility)
    
    def faculty(self):
        return self.get_queryset().faculty()