# faction/urls.py

from django.urls import path, include
from rest_framework.routers import DefaultRouter

from .views import faction, attendee, leader


router = DefaultRouter()
router.register(r"factions", faction.FactionViewSet)
router.register(r"attendee", attendee.AttendeeViewSet)

urlpatterns = [
    # REST API
    path("", include(router.urls)),


    ############################################
    ## Faction URLs ############################
    ############################################

    # Index
    path("factions/", faction.faction_index, name="faction_index"),
    path(
        "factions/<int:faction_id>/children/",
        faction.faction_index_by_faction,
        name="faction_index_by_faction",
    ),
    path(
        "factions/<slug:faction_slug>/children/",
        faction.faction_index_by_faction,
        name="faction_index_by_faction",
    ),
    path(
        "organizations/<int:organization_id>/factions",
        faction.faction_index_by_organization,
        name="faction_index_by_organization",
    ),
    path(
        "organizations/<slug:organization_slug>/",
        faction.faction_index_by_organization,
        name="faction_index_by_organization",
    ),

    # New
    path("factions/new/", faction.CreateView.as_view(), name="faction_new"),

    # Show
    path("factions/<int:faction_id>/", faction.faction_show, name="faction_show"),
    path("factions/<slug:faction_slug>/", faction.faction_show, name="faction_show"),
    
    path("<slug:faction_slug>/new/", faction.CreateView.as_view(), name="faction_new"),
    # Manage
    path("my-faction/", faction.MyFactionView.as_view(), name="my_faction"),


    ############################################
    ## Leader URLs #############################
    ############################################

    # Index
    path("leaders/", leader.leader_index, name="leader_index"),
    path(
        "factions/<int:faction_id>/leaders/",
        leader.leader_index_by_faction,
        name="leader_index_by_faction",
    ),
    path(
        "factions/<slug:faction_slug>/leaders/",
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

    # New
    path("leaders/new/", leader.CreateView.as_view(), name="leader_new"),
    path(
        "factions/<slug:faction_slug>/leaders/new/",
        leader.CreateView.as_view(),
        name="leader_new",
    ),
    path(
        "organizations/<slug:organization_slug>/leaders/new/",
        leader.CreateView.as_view(),
        name="leader_new",
    ),

    # Show
    path("leaders/<slug:leader_slug>/", leader.leader_show, name="leader_show"),


    ############################################
    ## Attendee URLs ###########################
    ############################################

    # Index
    path("attendees/", attendee.attendee_index, name="attendee_index"),
    path(
        "factions/<int:faction_id>/attendees/",
        attendee.attendee_index_by_faction,
        name="attendee_index_by_faction",
    ),
    path(
        "factions/<slug:faction_slug>/attendees/",
        attendee.attendee_index_by_faction,
        name="attendee_index_by_faction",
    ),
    path(
        "organizations/<int:organization_id>/attendees/",
        attendee.attendee_index_by_organization,
        name="attendee_index_by_organization",
    ),
    path(
        "organizations/<slug:organization_slug>/attendees/",
        attendee.attendee_index_by_organization,
        name="attendee_index_by_organization",
    ),

    # New
    path("attendees/new/", attendee.CreateView.as_view(), name="attendee_new"),
    path(
        "factions/<slug:faction_slug>/attendees/new/",
        attendee.CreateView.as_view(),
        name="attendee_new",
    ),

    # Show
    path(
        "attendees/<slug:attendee_slug>/", attendee.attendee_show, name="attendee_show"
    ),
]
