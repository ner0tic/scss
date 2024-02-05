# Generated by Django 5.0.1 on 2024-01-21 18:21

import django.db.models.deletion
from django.db import migrations, models


class Migration(migrations.Migration):
    dependencies = [
        ("facility", "0002_initial"),
        ("organization", "0001_initial"),
    ]

    operations = [
        migrations.AlterField(
            model_name="facultyprofile",
            name="facility",
            field=models.ForeignKey(
                blank=True,
                null=True,
                on_delete=django.db.models.deletion.CASCADE,
                to="facility.facility",
            ),
        ),
        migrations.AlterField(
            model_name="facultyprofile",
            name="organization",
            field=models.ForeignKey(
                blank=True,
                null=True,
                on_delete=django.db.models.deletion.CASCADE,
                to="organization.organization",
            ),
        ),
    ]
