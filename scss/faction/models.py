""" Faction Related Models. """
from django.contrib.auth.models import AbstractUser
from django.db import models

class Faction(models.Model):
    """ Faction Model. """
    name = models.CharField(max_length=100)
    abbreviation = models.CharField(max_length=50)
    description = models.TextField()

    organization = models.ForeignKey('Organization', on_delete=models.CASCADE)

    # enrollments


class Attendee(AbstractUser):
    """ Attendee Model. """
    faction = models.ForeignKey('Faction', on_delete=models.CASCADE)
    organization = models.ForeignKey('Organization', on_delete=models.CASCADE)
    # enrollments


class Leader(AbstractUser):
    """ Leader Model. """
    faction = models.ForeignKey('Faction', on_delete=models.CASCADE)
    organization = models.ForeignKey('Organization', on_delete=models.CASCADE)
    # enrollments
