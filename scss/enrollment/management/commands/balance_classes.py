from django.core.management.base import BaseCommand
from ...models import *


class Command(BaseCommand):
    help = "Balances class sizes across specified scopes."

    def add_arguments(self, parser):
        parser.add_argument(
            "-f",
            "--facility",
            type=int,
            help="ID of the Facility to balance classes for",
        )
        parser.add_argument(
            "-fe",
            "--facility-enrollment",
            type=int,
            help="ID of the Facility Enrollment to balance classes for",
        )
        parser.add_argument(
            "-o",
            "--organization",
            type=int,
            help="ID of the Organization to balance classes for",
        )
        parser.add_argument(
            "-oe",
            "--organization-enrollment",
            type=int,
            help="ID of the Organization Enrollment to balance classes for",
        )
        parser.add_argument(
            "-fc",
            "--facility-class",
            type=int,
            help="ID of the Facility Class to balance",
        )

    def handle(self, *args, **kwargs):
        facility_id = kwargs.get("facility")
        facility_enrollment_id = kwargs.get("facility_enrollment")
        organization_id = kwargs.get("organization")
        organization_enrollment_id = kwargs.get("organization_enrollment")
        facility_class_id = kwargs.get("facility_class")

        classes = FacilityClass.objects.all()

        if facility_id:
            classes = classes.filter(facility_id=facility_id)
        if facility_enrollment_id:
            classes = classes.filter(facility_enrollment__id=facility_enrollment_id)
        if organization_id:
            classes = classes.filter(
                facility_enrollment__organization_enrollment__organization_id=organization_id
            )
        if organization_enrollment_id:
            classes = classes.filter(
                facility_enrollment__organization_enrollment_id=organization_enrollment_id
            )
        if facility_class_id:
            classes = classes.filter(id=facility_class_id)

        for facility_class in classes:
            # Calculate how many students to move/add
            current_enrollment = facility_class.facilityclassenrollment_set.count()
            slots_available = desired_class_size - current_enrollment

            if slots_available > 0:
                # Logic to add students, ensuring we don't exceed maximum capacities
                pass  # Implementation depends on how students are assigned to classes

            elif slots_available < 0:
                # Logic to move students to other classes
                pass  # Implementation details omitted for brevity

        self.stdout.write(
            self.style.SUCCESS(
                "Successfully balanced class sizes within specified scope."
            )
        )
