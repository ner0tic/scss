from django.core.management.base import BaseCommand
from django.apps import apps
from django.core import serializers
from django_dynamic_fixture import G
import os


class Command(BaseCommand):
    help = "Generate fixtures for all models or specific app/model using DDF."

    def add_arguments(self, parser):
        parser.add_argument(
            "app_label",
            nargs="?",
            type=str,
            help="App label of the application to generate fixtures for.",
        )
        parser.add_argument(
            "model_name",
            nargs="?",
            type=str,
            help="Model name to generate fixtures for.",
        )
        parser.add_argument(
            "--count",
            type=int,
            default=5,
            help="Number of instances to generate for each model.",
        )

    def handle(self, *args, **options):
        app_label = options["app_label"]
        model_name = options["model_name"]
        count = options["count"]
        apps_list = (
            [app_label] if app_label else [app.name for app in apps.get_app_configs()]
        )

        for app in apps_list:
            model_list = (
                apps.get_app_config(app).get_models()
                if not model_name
                else [apps.get_model(app, model_name)]
            )
            for model in model_list:
                self.generate_ddf_fixtures(model, app, count)

    def generate_ddf_fixtures(self, model, app_label, count):
        fixture_dir = os.path.join("fixtures", app_label)
        if not os.path.exists(fixture_dir):
            os.makedirs(fixture_dir)

        fixture_file_path = os.path.join(fixture_dir, f"{model._meta.model_name}.json")

        # Generate model instances using DDF
        instances = [G(model) for _ in range(count)]  # Generate 'count' instances

        # Serialize model instances to JSON
        serialized_data = serializers.serialize("json", instances, indent=2)

        # Write serialized data to fixture file
        with open(fixture_file_path, "w") as fixture_file:
            fixture_file.write(serialized_data)

        self.stdout.write(
            self.style.SUCCESS(
                f"Successfully generated {count} fixture(s) for {app_label}.{model._meta.model_name}"
            )
        )
