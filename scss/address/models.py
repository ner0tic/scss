""" Address Related Models. """

from django.db import models

from pages.mixins import models as mixins


class Address(mixins.GenericRelationMixin, models.Model):
    street = models.CharField(max_length=128)
    street2 = models.CharField(max_length=128, null=True, blank=True)
    city = models.CharField(max_length=64)
    state = models.CharField(max_length=64)
    zip_code = models.CharField(max_length=20)
    country = models.CharField(max_length=50)

    class Meta:
        verbose_name = "Address"
        verbose_name_plural = "Addresses"

    def __str__(self):
        return (
            f"{self.street}, {self.street2}, {self.city}, {self.state}, {self.zip_code}, {self.country}"
        )
