# faction/views/attendee.py

from rest_framework import viewsets

from django.shortcuts import render, get_object_or_404, redirect
from django.contrib.auth import authenticate, login
from django.contrib.auth.decorators import login_required, permission_required

from user.models import User
from organization.models import Organization, OrganizationSettings, OrganizationLabels

from ..models import Faction
from ..serializers import AttendeeSerializer


class AttendeeViewSet(viewsets.ModelViewSet):
    queryset = User.objects.filter(user_type=User.UserType.ATTENDEE)
    serializer_class = AttendeeSerializer


def attendee_index(request):
    """Attendee list view."""

    attendees = User.objects.filter(user_type=User.UserType.ATTENDEE)

    return render(request, "attendee/index.html", {"attendees": attendees})


def attendee_index_by_faction(request, faction_id=None, faction_slug=None):
    """Attendee list by Faction view."""
    if faction_id:
        faction = get_object_or_404(Faction, pk=faction_id)
    else:
        faction = get_object_or_404(Faction, slug=faction_slug)

    attendees = User.objects.filter(attendeeprofile__faction=faction)

    return render(
        request, "attendee/index.html", {"attendees": attendees, "faction": faction}
    )


def attendee_index_by_organization(
    request, organization_id=None, organization_slug=None
):
    """Attendee list by Organizaton view."""

    if organization_id:
        organization = get_object_or_404(Organization, pk=organization_id)
    else:
        organization = get_object_or_404(Organization, slug=organization_slug)

    attendees = User.objects.filter(attendeeprofile__organization=organization)

    return render(
        request,
        "attendee/index.html",
        {"attendees": attendees, "organization": organization},
    )


def attendee_show(request, attendee_id=None, attendee_slug=None):
    """Attendee details view."""

    if attendee_id:
        attendee = get_object_or_404(User, pk=attendee_id)
    else:
        attendee = get_object_or_404(User, slug=attendee_slug)

    return render(request, "attendee/show.html", {"attendee": attendee})
