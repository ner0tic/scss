""" Faction Related URLs. """

from rest_framework.routers import DefaultRouter

from django.urls import path, include

from .views import attendee, faction, leader
from .widgets import AttendeeListWidget, LeaderListWidget

router = DefaultRouter()
router.register(r"factions", faction.FactionViewSet)
router.register(r"attendee", attendee.AttendeeViewSet)
#router.register(r"leaders", leader.LeaderViewSet)

urlpatterns = [
    # REST API
    path(r"", include(router.urls)),
    ########################
    # Faction Related URLs #
    ########################
    path("factions/", faction.faction_index, name="faction_index"),
    path(
        "organizations/<int:organization_id>/factions/",
        faction.faction_index_by_organization,
        name="faction_index_by_organization",
    ),
    path(
        "organizations/<slug:organization_slug>/factions/",
        faction.faction_index_by_organization,
        name="faction_index_by_organization",
    ),
    path("factions/<int:faction_id>", faction.faction_show, name="faction_show"),
    path("factions/<slug:faction_slug>", faction.faction_show, name="faction_show"),
    path(
        "factions/<int:faction_id>/children",
        faction.faction_index_by_faction,
        name="faction_index_by_faction",
    ),
    path(
        "factions/<slug:faction_slug>/children",
        faction.faction_index_by_faction,
        name="faction_index_by_faction",
    ),
    #######################
    # Leader Related URLs #
    #######################
    path("leaders/", leader.leader_index, name="leader_index"),
    path(
        "factions/<int:faction_id>/leaders",
        leader.leader_index_by_faction,
        name="leader_index_by_faction",
    ),
    path(
        "factions/<slug:faction_slug>/leaders",
        leader.leader_index_by_faction,
        name="leader_index_by_faction",
    ),
    path(
        "organizations/<int:organization_id>/leaders",
        leader.leader_index_by_organization,
        name="leader_index_by_organization",
    ),
    path(
        "organizations/<slug:organization_slug>/leaders",
        leader.leader_index_by_organization,
        name="leader_index_by_organization",
    ),
    #########################
    # Attendee Related URLs #
    #########################
    path("attendees/", attendee.attendee_index, name="attendee_index"),
    path(
        "factions/<int:faction_id>/attendees",
        attendee.attendee_index_by_faction,
        name="attendee_index_by_faction",
    ),
    path(
        "factions/<slug:faction_slug>/attendees",
        attendee.attendee_index_by_faction,
        name="attendee_index_by_faction",
    ),
    path(
        "organizations/<int:organization_id>/attendees",
        attendee.attendee_index_by_organization,
        name="attendee_index_by_organization",
    ),
    path(
        "organizations/<slug:organization_slug>/attendees",
        attendee.attendee_index_by_organization,
        name="attendee_index_by_organization",
    ),
    path(
        "attendees/<slug:attendee_slug>",
        attendee.attendee_show,
        name="attendee_show",
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
