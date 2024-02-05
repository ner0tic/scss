from django.core.management.base import BaseCommand
from django.core import serializers
from django.apps import apps
from django.conf import settings
import os


class Command(BaseCommand):
    help = "Generate fixtures for specified app and/or model."

    def add_arguments(self, parser):
        parser.add_argument("app_label", nargs="?", help="App label of the application")
        parser.add_argument(
            "model_name", nargs="?", help="Model name to generate fixtures for"
        )

    def handle(self, *args, **options):
        app_label = options["app_label"]
        model_name = options["model_name"]

        if app_label:
            try:
                app_list = [apps.get_app_config(app_label)]
                models = (
                    app_config.get_models()
                    if not model_name
                    else [apps.get_model(app_label, model_name)]
                )
            except LookupError as e:
                self.stdout.write(self.style.ERROR(str(e)))
                return
        else:
            apps_list = apps.get_app_configs()

        for app_config in apps_list:
            model_list = (
                [apps.get_model(app_config.label, model_name)]
                if model_name
                else app_config.get_models()
            )
            for model in model_list:
                current_app_label = model._meta.app_label
                current_model_name = model._meta.model_name

                # Define fixture file path
                fixture_dir = os.path.join(settings.BASE_DIR, current_app_label, "fixtures")
                if not os.path.exists(fixture_dir):
                    os.makedirs(fixture_dir)
                fixture_file = os.path.join(fixture_dir, f"{current_model_name}.json")

                # Fetch model objects and serialize them to JSON
                objects = model.objects.all()
                data = serializers.serialize("json", objects, indent=4)

                # Write the JSON data to the fixture file
                with open(fixture_file, "w") as file:
                    file.write(data)

                self.stdout.write(
                    self.style.SUCCESS(
                        f"Generated fixture for {current_app_label}.{current_model_name}"
                    )
                )
