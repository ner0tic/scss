# enrollments/{faction_enrollment.slug}/ #show
# enrollments/{faction_enrollment.slug/attendees}
""" Enrollment Related URLs. """
from django.urls import path

from . import views

urlpatterns = [
    # Organization Enrollment Related URLs
    path(
        "organization-enrollments/",
        views.organization_enrollment_index,
        name="organization_enrollment_index",
    ),
    path(
        "organization-enrollments/year/<int:year>/",
        views.organization_enrollment_index_by_year,
        name="organization_enrollment_index_by_year",
    ),
    path(
        "organizations/<int:organization_id>/enrollments",
        views.organization_enrollment_index_by_organization,
        name="organization_enrollment_index_by_organization",
    ),
    path(
        "organizations/<str:organization_slug>/enrollments",
        views.organization_enrollment_index_by_organization,
        name="organization_enrollment_index_by_organization",
    ),
    # Week Related URLs
    # Period Related URLs
    # Facility Enrollment Related URLs
    # Faction Enrollment Related URLs
    path(
        "faction-enrollments/",
        views.faction_enrollment_index,
        name="faction_enrollment_index",
    ),
    path(
        "faction-enrollments/year/<int:year>/",
        views.faction_enrollment_index_by_year,
        name="faction_enrollment_index_by_year",
    ),
    path(
        "factions/<int:faction_id>/enrollments/",
        views.faction_enrollment_index_by_faction,
        name="faction_enrollment_index_by_faction",
    ),
    path(
        "my-enrollments/faction-enrollments",
        views.faction_enrollment_index_by_current_user,
        name="faction_enrollment_index_by_current_user",
    ),
    path(
        "factions/<str:faction_slug>/enrollments/",
        views.faction_enrollment_index_by_faction,
        name="faction_enrollment_index_by_faction",
    ),
    path(
        "faction/<int:faction_id>/enrollments/year/<int:year>/",
        views.faction_enrollment_index_by_year_and_faction,
        name="faction_enrollment_index_by_year_and_faction",
    ),
    # Leader Enrollment Related URLs
    # Attendee Enrollment Related URLs
    # Attendee Class Enrollment Related URLs
    # Organization Course Related URLs
    # Facility Class Related URLs
    # Facility Class Enrollment Related URLs
    # Faculty Class Enrollment Related URLs
    # Active Enrollment Related URLs
]
