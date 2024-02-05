# Generated by Django 5.0.1 on 2024-01-21 13:10

import django.contrib.auth.models
import django.db.models.deletion
import django.db.models.manager
from django.conf import settings
from django.db import migrations, models


class Migration(migrations.Migration):
    initial = True

    dependencies = [
        ("facility", "0001_initial"),
        ("organization", "0001_initial"),
        ("user", "0001_initial"),
        migrations.swappable_dependency(settings.AUTH_USER_MODEL),
    ]

    operations = [
        migrations.CreateModel(
            name="Faculty",
            fields=[],
            options={
                "proxy": True,
                "indexes": [],
                "constraints": [],
            },
            bases=("user.user",),
            managers=[
                ("faculty", django.db.models.manager.Manager()),
                ("objects", django.contrib.auth.models.UserManager()),
            ],
        ),
        migrations.AddField(
            model_name="department",
            name="parent",
            field=models.ForeignKey(
                blank=True,
                null=True,
                on_delete=django.db.models.deletion.CASCADE,
                related_name="children",
                to="facility.department",
            ),
        ),
        migrations.AddField(
            model_name="facility",
            name="organization",
            field=models.ForeignKey(
                on_delete=django.db.models.deletion.CASCADE,
                to="organization.organization",
            ),
        ),
        migrations.AddField(
            model_name="department",
            name="facility",
            field=models.ForeignKey(
                on_delete=django.db.models.deletion.CASCADE, to="facility.facility"
            ),
        ),
        migrations.AddField(
            model_name="facultyprofile",
            name="facility",
            field=models.ForeignKey(
                on_delete=django.db.models.deletion.CASCADE, to="facility.facility"
            ),
        ),
        migrations.AddField(
            model_name="facultyprofile",
            name="organization",
            field=models.ForeignKey(
                on_delete=django.db.models.deletion.CASCADE,
                to="organization.organization",
            ),
        ),
        migrations.AddField(
            model_name="facultyprofile",
            name="user",
            field=models.OneToOneField(
                on_delete=django.db.models.deletion.CASCADE, to=settings.AUTH_USER_MODEL
            ),
        ),
        migrations.AddField(
            model_name="quarters",
            name="facility",
            field=models.ForeignKey(
                on_delete=django.db.models.deletion.CASCADE, to="facility.facility"
            ),
        ),
    ]
