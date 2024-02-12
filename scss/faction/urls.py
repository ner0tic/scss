""" Faction Related URLs. """

from django.urls import path

from . import views
from .widgets import AttendeeListWidget, LeaderListWidget

urlpatterns = [
    ########################
    # Faction Related URLs #
    ########################
    path("factions/", views.faction_index, name="faction_index"),
    path(
        "organizations/<int:organization_id>/factions/",
        views.faction_index_by_organization,
        name="faction_index_by_organization",
    ),
    path(
        "organizations/<slug:organization_slug>/factions/",
        views.faction_index_by_organization,
        name="faction_index_by_organization",
    ),
    path("factions/<int:faction_id>", views.faction_show, name="faction_show"),
    path("factions/<slug:faction_slug>", views.faction_show, name="faction_show"),
    #######################
    # Leader Related URLs #
    #######################
    path("leaders/", views.leader_index, name="leader_index"),
    path(
        "factions/<int:faction_id>/leaders",
        views.leader_index_by_faction,
        name="leader_index_by_faction",
    ),
    path(
        "factions/<slug:faction_slug>/leaders",
        views.leader_index_by_faction,
        name="leader_index_by_faction",
    ),
    path(
        "organizations/<int:organization_id>/leaders",
        views.leader_index_by_organization,
        name="leader_index_by_organization",
    ),
    path(
        "organizations/<slug:organization_slug>/leaders",
        views.leader_index_by_organization,
        name="leader_index_by_organization",
    ),
    #########################
    # Attendee Related URLs #
    #########################
    path("attendees/", views.attendee_index, name="attendee_index"),
    path(
        "factions/<int:faction_id>/attendees",
        views.attendee_index_by_faction,
        name="attendee_index_by_faction",
    ),
    path(
        "factions/<slug:faction_slug>/attendees",
        views.attendee_index_by_faction,
        name="attendee_index_by_faction",
    ),
    path(
        "organizations/<int:organization_id>/attendees",
        views.attendee_index_by_organization,
        name="attendee_index_by_organization",
    ),
    path(
        "organizations/<slug:organization_slug>/attendees",
        views.attendee_index_by_organization,
        name="attendee_index_by_organization",
    ),
    ###################################
    # Dashboard Widget Related Routes #
    ###################################
    path(
        "attendee-list-widget/",
        AttendeeListWidget.as_view(),
        name="attendee_list_widget",
    ),
    path("leader-list-widget/", LeaderListWidget.as_view(), name="leader_list_widget"),
]
