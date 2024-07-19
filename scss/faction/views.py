""" Faction Related Views. """

from rest_framework import viewsets

from django.shortcuts import render, get_object_or_404, redirect
from django.contrib.auth import authenticate, login
from django.contrib.auth.decorators import login_required, permission_required

from organization.models import Organization

from .forms import AttendeeRegistrationForm, LeaderRegistrationForm
from .models import Attendee, Faction, Leader
from .serializers import FactionSerializer, LeaderSerializer, AttendeeSerializer


class FactionViewSet(viewsets.ModelViewSet):
    queryset = Faction.objects.all()
    serializer_class = FactionSerializer


class LeaderViewSet(viewsets.ModelViewSet):
    queryset = Leader.objects.all()
    serializer_class = LeaderSerializer


class AttendeeViewSet(viewsets.ModelViewSet):
    queryset = Attendee.objects.all()
    serializer_class = AttendeeSerializer


def register_attendee(request):
    """Attendee Registration View."""
    if request.method == "POST":
        form = AttendeeRegistrationForm(request.POST)
        if form.is_valid():
            form.save()
            username = form.cleaned_data.get("username")
            raw_password = form.cleaned_data.get("password1")
            user = authenticate(username=username, password=raw_password)
            login(request, user)
            return redirect("home")  # Redirect to a home page or appropriate view
    else:
        form = AttendeeRegistrationForm()
    return render(request, "register_attendee.html", {"form": form})


def register_leader(request):
    """Leader Registration View."""
    if request.method == "POST":
        form = LeaderRegistrationForm(request.POST)
        if form.is_valid():
            form.save()
            username = form.cleaned_data.get("username")
            raw_password = form.cleaned_data.get("password1")
            user = authenticate(username=username, password=raw_password)
            login(request, user)
            return redirect("home")  # Redirect to a home page or appropriate view
    else:
        form = LeaderRegistrationForm()
    return render(request, "register_leader.html", {"form": form})


#########################
# Faction Related Views #
#########################
def faction_index(request):
    """Faction list view."""
    factions = Faction.objects.all()

    return render(request, "faction/list.html", {"factions": factions})


def faction_index_by_organization(
    request, organization_id=None, organization_slug=None
):
    """Faction list by Organization view."""
    if organization_id:
        organization = get_object_or_404(Organization, pk=organization_id)
    else:
        organization = get_object_or_404(Organization, slug=organization_slug)

    factions = Faction.objects.by_organization(organization.id)

    return render(
        request,
        "faction/list.html",
        {"organization": organization, "factions": factions},
    )


def faction_index_by_faction(request, faction_id=None, faction_slug=None):
    """Faction List by Parent view."""
    if faction_id:
        faction = get_object_or_404(Faction, pk=faction_id)
    else:
        faction = get_object_or_404(Faction, slug=faction_slug)

    factions = Faction.objects.by_faction(faction.id)

    return render(
        request, "faction/list.html", {"faction": faction, "factions": factions}
    )


def faction_show(request, faction_id=None, faction_slug=None):
    """Faction details view."""
    if faction_id:
        faction = get_object_or_404(Faction, pk=faction_id)
    else:
        faction = get_object_or_404(Faction, slug=faction_slug)

    return render(request, "faction/show.html", {"faction": faction})


########################
# Leader Related Views #
########################
def leader_index(request):
    """Leader list view."""
    leaders = Leader.objects.all()

    return render(request, "leader/list.html", {"leaders": leaders})


def leader_index_by_faction(request, faction_id=None, faction_slug=None):
    """Leader list by Faction view."""
    if faction_id:
        faction = get_object_or_404(Faction, pk=faction_id)
    else:
        faction = get_object_or_404(Faction, slug=faction_slug)

    leaders = Leader.objects.filter(leaderprofile__faction=faction)

    return render(request, "leader/list.html", {"leaders": leaders, "faction": faction})


def leader_index_by_organization(request, organization_id=None, organization_slug=None):
    """Leader list by Organizaton view."""
    if organization_id:
        organization = get_object_or_404(Organization, pk=organization_id)
    else:
        organization = get_object_or_404(Organization, slug=organization_slug)

    leaders = Leader.objects.filter(leaderprofile__organization=organization)


def leader_show(request, leader_id=None, leader_slug=None):
    """Leader details view."""

    if leader_id:
        leader = get_object_or_404(Leader, pk=leader_id)
    else:
        leader = get_object_or_404(Leader, slug=leader_slug)

    return render(request, "leader/show.html", {"leader": leader})


########################
# Attendee Related Views #
########################
def attendee_index(request):
    """Attendee list view."""
    attendees = Attendee.objects.all()

    return render(request, "attendee/list.html", {"attendees": attendees})


def attendee_index_by_faction(request, faction_id=None, faction_slug=None):
    """Attendee list by Faction view."""
    if faction_id:
        faction = get_object_or_404(Faction, pk=faction_id)
    else:
        faction = get_object_or_404(Faction, slug=faction_slug)

    attendees = Attendee.objects.filter(attendeeprofile__faction=faction)

    return render(
        request, "attendee/list.html", {"attendees": attendees, "faction": faction}
    )


def attendee_index_by_organization(
    request, organization_id=None, organization_slug=None
):
    """Attendee list by Organizaton view."""
    if organization_id:
        organization = get_object_or_404(Organization, pk=organization_id)
    else:
        organization = get_object_or_404(Organization, slug=organization_slug)

    attendees = Attendee.objects.filter(attendeeprofile__organization=organization)


def attendee_show(request, attendee_id=None, attendee_slug=None):
    """Attendee details view."""

    if attendee_id:
        attendee = get_object_or_404(Attendee, pk=attendee_id)
    else:
        attendee = get_object_or_404(Attendee, slug=attendee_slug)

    return render(request, "attendee/show.html", {"attendee": attendee})
