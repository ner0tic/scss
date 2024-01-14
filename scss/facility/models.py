""" Facility Related Models. """
from django.db import models
from django.contrib.auth.models import AbstractUser

class Facility(models.Model):
    """ Facility Model. """
    name = models.CharField(max_length=100)
    description = models.TextField()

    address = models.ForeignKey('Address', on_delete=models.CASCADE)
    organization = models.ForeignKey('Organization', on_delete=models.CASCADE)

    def __str__(self):
        return self.name


class Quarters(models.Model):
    """ Quarters Model. """
    name = models.CharField(max_length=100)
    description = models.TextField()
    capacity = models.IntegerField()
    type = models.CharField(max_length=50)

    facility = models.ForeignKey('Facility', on_delete=models.CASCADE)

    def is_faction(self):
        return self.type == 'faction'

    def is_leader(self):
        return self.type == 'leader'

    def is_attendee(self):
        return self.type == 'attendee'

    def is_faculty(self):
        return self.type == 'faculty'

    def is_other(self):
        return self.type == 'other'

    def __str__(self):
        return self.name


class Department(models.Model):
    """ Department Model. """
    name = models.CharField(max_length=100)
    abbreviation = models.CharField(max_length=50)
    description = models.TextField()

    facility = models.ForeignKey('Facility', on_delete=models.CASCADE)

    def __str__(self):
        return self.name


class Faculty(AbstractUser):
    """ Faculty Model. """
    facility = models.ForeignKey(Facility, on_delete=models.SET_NULL, null=True, blank=True)
    #enrollments = models.ManyToManyField('FacultyEnrollment')
