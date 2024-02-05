""" Facility URLs. """
from django.urls import path
from . import views
from .widgets import FacultyListWidget

urlpatterns = [
    path("facilities/", views.facility_index, name="facility_index"),
    path("facilities/<int:facility_id>/", views.facility_show, name="facility_show"),
    path("facilities/<str:facility_slug>/", views.facility_show, name="facility_show"),
    path(
        "organizations/<int:organization_id>/facilities",
        views.facility_index_by_organization,
        name="facility_index_by_organization",
    ),
    path(
        "organizations/<str:organization_slug>/facilities",
        views.facility_index_by_organization,
        name="facility_index_by_organization",
    ),

    # Faculty Related Routes
    path(
        "facilities/<int:facility_id>/faculty",
        views.faculty_index_by_facility,
        name="faculty_index_by_facility",
    ),
    path(
        "facilities/<str:facility_slug>/faculty",
        views.faculty_index_by_facility,
        name="faculty_index_by_facility",
    ),
    path(
        "faculty/<int:facility_id>",
        views.faculty_show,
        name="faculty_show",
    ),
    path(
        "faculty/<str:facility_slug>",
        views.faculty_show,
        name="faculty_show"
    ),
    #############################
    # Department Related Routes #
    #############################
    path(
        "facilities/<int:facility_id>/departments",
        views.department_index_by_facility,
        name="department_index_by_facility",
    ),
    path(
        "facilities/<str:facility_slug>/departments",
        views.department_index_by_facility,
        name="department_index_by_facility",
    ),
    path(
        "departments/<int:department_id>",
        views.department_show,
        name="department_show",
    ),
    path(
        "departments/<str:department_slug>",
        views.department_show,
        name="department_show",
    ),
    ###########################
    # Quarters Related Routes #
    ###########################
    path(
        "facilities/<int:facility_id>/quarters",
        views.quarters_index_by_facility,
        name="quarters_index_by_facility",
    ),
    path(
        "facilities/<str:facility_slug>/quarters",
        views.quarters_index_by_facility,
        name="quarters_index_by_facility",
    ),
    path(
        "quarters/<int:quarters_int>",
        views.quarters_show,
        name="quarters_show",
    ),
    path(
        "quarters/<str:quarters_slug>",
        views.quarters_show,
        name="quarters_show",
    ),
    ###################################
    # Dashboard Widget Related Routes #
    ###################################
    path('faculty-list-widget/', FacultyListWidget.as_view(), name='faculty_list_widget'),
]
