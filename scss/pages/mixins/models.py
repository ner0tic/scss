# pages/mixins/models.py

import uuid
from rest_framework import serializers
from datetime import datetime
from django.conf import settings
from django.db import models
from django.core.exceptions import ValidationError
from django.utils.translation import gettext_lazy as _
from django.utils.timezone import now
from django.utils.text import slugify
from django.contrib.contenttypes.fields import GenericForeignKey
from django.contrib.contenttypes.models import ContentType

class NameDescriptionMixin(models.Model):
    name = models.CharField(max_length=100)
    description = models.TextField()

    class Meta:
        abstract = True


class TimestampMixin(models.Model):
    created_at = models.DateTimeField(auto_now_add=True)
    updated_at = models.DateTimeField(auto_now=True)

    class Meta:
        abstract = True


class SoftDeleteMixin(models.Model):
    is_deleted = models.BooleanField(default=False)
    deleted_at = models.DateTimeField(null=True, blank=True)

    def delete(self, *args, **kwargs):
        self.is_deleted = True
        self.deleted_at = now()
        self.save()

    class Meta:
        abstract = True


class AuditMixin(models.Model):
    created_by = models.ForeignKey(settings.AUTH_USER_MODEL, related_name="created_%(class)s_set", on_delete=models.SET_NULL, null=True, blank=True)
    updated_by = models.ForeignKey(settings.AUTH_USER_MODEL, related_name="updated_%(class)s_set", on_delete=models.SET_NULL, null=True, blank=True)

    class Meta:
        abstract = True


class SlugMixin(models.Model):
    slug = models.SlugField(max_length=255, unique=True, blank=True)

    def generate_slug(self, field=None):
        if field:
            if hasattr(self, field):
                return slugify(f"{getattr(self, field)}")
        else:
            if hasattr(self, 'get_full_name'):
                return slugify(f"{self.get_full_name()}")
            elif hasattr(self, 'title'):
                return slugify(f"{self.title}")
            elif hasattr(self, 'name'):
                return slugify(f"{self.name}")
        return slugify(f"{self.__str__()}")

    def save(self, *args, **kwargs):
        if not self.slug:
            self.slug = self.generate_slug()
            original_slug = self.slug
            counter = 1

            while self.__class__.objects.filter(slug=self.slug).exists():
                self.slug = f"{original_slug}-{counter}"
                counter += 1
        super().save(*args, **kwargs)

    class Meta:
        abstract = True


class OrderedModelMixin(models.Model):
    order = models.PositiveIntegerField(default=0)

    class Meta:
        abstract = True
        ordering = ['order']


class ActiveMixin(models.Model):
    is_active = models.BooleanField(default=True)

    class Meta:
        abstract = True


class UUIDMixin(models.Model):
    id = models.UUIDField(primary_key=True, default=uuid.uuid4, editable=False)

    class Meta:
        abstract = True


class TrackChangesMixin(models.Model):
    change_message = models.CharField(max_length=255, blank=True, null=True)

    def save(self, *args, **kwargs):
        if self.pk:
            self.change_message = 'Updated: {}'.format(', '.join(self.changed_fields))
        else:
            self.change_message = 'Created'
        super().save(*args, **kwargs)

    @property
    def changed_fields(self):
        if not self.pk:
            return []
        old_values = self.__class__.objects.get(pk=self.pk)
        changed_fields = []
        for field in self._meta.get_fields():
            if not hasattr(field, 'attname'):
                continue
            old_value = getattr(old_values, field.attname, None)
            new_value = getattr(self, field.attname, None)
            if old_value != new_value:
                changed_fields.append(field.name)
        return changed_fields

    class Meta:
        abstract = True


class GenericRelationMixin(models.Model):
    content_type = models.ForeignKey(ContentType, on_delete=models.CASCADE)
    object_id = models.PositiveIntegerField()
    content_object = GenericForeignKey('content_type', 'object_id')

    class Meta:
        abstract = True


class ImageMixin(models.Model):
    image = models.ImageField(upload_to='images/')

    class Meta:
        abstract = True


class SEOFieldsMixin(models.Model):
    seo_title = models.CharField(max_length=70, blank=True, null=True)
    seo_description = models.CharField(max_length=160, blank=True, null=True)
    seo_keywords = models.CharField(max_length=255, blank=True, null=True)

    class Meta:
        abstract = True


class ParentChildMixin(models.Model):
    parent = models.ForeignKey('self', on_delete=models.CASCADE, null=True, blank=True, related_name='children')

    class Meta:
        abstract = True


class DateRangeMixin(models.Model):
    start = models.DateTimeField(_("start"), default=datetime.now)
    end = models.DateTimeField(_("end"))

    def clean(self):
        if self.end <= self.start:
            raise ValidationError(_("End date must be after start date"))

    class Meta:
        abstract = True


# Serializers don't need Meta classes and can stay as is
class CreateUpdateSerializerMixin(serializers.ModelSerializer):
    def create(self, validated_data):
        instance = self.Meta.model(**validated_data)
        instance.save()
        return instance

    def update(self, instance, validated_data):
        for attr, value in validated_data.items():
            setattr(instance, attr, value)
        instance.save()
        return instance


class DynamicFieldsModelSerializer(serializers.ModelSerializer):
    def __init__(self, *args, **kwargs):
        fields = kwargs.pop('fields', None)
        super().__init__(*args, **kwargs)
        if fields:
            allowed = set(fields)
            existing = set(self.fields)
            for field_name in existing - allowed:
                self.fields.pop(field_name)
