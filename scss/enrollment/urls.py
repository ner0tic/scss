# enrollment/urls.py

from django.urls import path, include
from rest_framework.routers import DefaultRouter

from . import views

router = DefaultRouter()

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
    path(
        "factions/<int:faction_id>/enrollments/<int:faction_enrollment_id>/leaders",
        views.leader_enrollment_index_by_faction_enrollment,
        name="leader_enrollment_index_by_faction_enrollment",
    ),
    path(
        "factions/<slug:faction_slug>/enrollments/<slug:faction_enrollment_slug>/leaders",
        views.leader_enrollment_index_by_faction_enrollment,
        name="leader_enrollment_index_by_faction_enrollment",
    ),
    # Attendee Enrollment Related URLs
    path(
        "factions/<int:faction_id>/enrollments/<int:faction_enrollment_id>/attendees",
        views.attendee_enrollment_index_by_faction_enrollment,
        name="attendee_enrollment_index_by_faction_enrollment",
    ),
    path(
        "factions/<slug:faction_slug>/enrollments/<slug:faction_enrollment_slug>/attendees",
        views.attendee_enrollment_index_by_faction_enrollment,
        name="attendee_enrollment_index_by_faction_enrollment",
    ),
    # Attendee Class Enrollment Related URLs
    path(
        "my-schedule",
        views.my_schedule,
        name="my_schedule"
    ),
    path(
        "attendees/<slug:attendee_slug>/enrollments/<slug:attendee_enrollment>/enrollments",
        views.attendee_class_enrollment_index_by_attendee_enrollment,
        name="attendee_class_enrollment_index_by_attendee_enrollment"
    ),
    # Organization Course Related URLs
    # Facility Class Related URLs
    # Facility Class Enrollment Related URLs
    # Faculty Class Enrollment Related URLs
    # Active Enrollment Related URLs
    path("my-enrollments/", views.my_enrollments, name="my_enrollments"),
]
