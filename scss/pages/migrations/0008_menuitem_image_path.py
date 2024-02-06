# Generated by Django 5.0.1 on 2024-02-03 17:04

from django.db import migrations, models


class Migration(migrations.Migration):
    dependencies = [
        ("pages", "0007_menuitem_css_class"),
    ]

    operations = [
        migrations.AddField(
            model_name="menuitem",
            name="image_path",
            field=models.CharField(
                blank=True,
                help_text="Relative path to a static image",
                max_length=255,
                null=True,
            ),
        ),
    ]