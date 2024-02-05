# Generated by Django 5.0.1 on 2024-01-24 10:46

from django.db import migrations, models


class Migration(migrations.Migration):
    dependencies = [
        ("enrollment", "0002_initial"),
    ]

    operations = [
        migrations.AddField(
            model_name="facilityenrollment",
            name="slug",
            field=models.SlugField(blank=True, max_length=255, unique=True),
        ),
        migrations.AddField(
            model_name="organizationenrollment",
            name="slug",
            field=models.SlugField(blank=True, max_length=255, unique=True),
        ),
        migrations.AddField(
            model_name="period",
            name="slug",
            field=models.SlugField(blank=True, max_length=255, unique=True),
        ),
        migrations.AddField(
            model_name="week",
            name="slug",
            field=models.SlugField(blank=True, max_length=255, unique=True),
        ),
    ]
