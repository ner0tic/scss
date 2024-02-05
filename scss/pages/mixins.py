""" Mixins. """
from django.db import models
from django.utils.text import slugify

class NameSlugMixin(models.Model):
    """ Generate and populate a slug field based on the name field. """
    slug = models.SlugField(max_length=255, unique=True, blank=True)

    class Meta:
        abstract = True

    def generate_slug(self):
        if hasattr(self, 'get_full_name'):
            return slugify(f"{self.get_full_name()}")
        if hasattr(self, 'title'):
            return slugify(f"{self.title}")
        return slugify(self.name)

    def save(self, *args, **kwargs):
        if not self.slug:
            self.slug = self.generate_slug()
            # Ensure the slug is unique
            original_slug = self.slug
            counter = 1
            while self.__class__.objects.filter(slug=self.slug).exists():
                self.slug = f"{original_slug}-{counter}"
                counter += 1
        super().save(*args, **kwargs)
