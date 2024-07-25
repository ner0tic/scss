# faction/views/leader.py

from rest_framework import viewsets

from django.shortcuts import render, get_object_or_404, redirect
from django.contrib.auth import authenticate, login
from django.contrib.auth.decorators import login_required, permission_required

from user.models import User
from organization.models import Organization, OrganizationSettings, OrganizationLabels

from ..models import Faction
from ..serializers import LeaderSerializer


class LeaderViewSet(viewsets.ModelViewSet):
    queryset = User.objects.filter(user_type='leader')
    serializer_class = LeaderSerializer


def leader_index(request):
    """Leader list view."""

    leaders = User.objects.filter(user_type=User.UserType.LEADER)

    return render(request, "leader/index.html", {"leaders": leaders})


def leader_index_by_faction(request, faction_id=None, faction_slug=None):
    """Leader list by Faction view."""
    if faction_id:
        faction = get_object_or_404(Faction, pk=faction_id)
    else:
        faction = get_object_or_404(Faction, slug=faction_slug)

    leaders = User.objects.filter(leaderprofile__faction=faction)

    return render(
        request, "leader/index.html", {"leaders": leaders, "faction": faction}
    )


def leader_index_by_organization(
    request, organization_id=None, organization_slug=None
):
    """Leader list by Organizaton view."""

    if organization_id:
        organization = get_object_or_404(Organization, pk=organization_id)
    else:
        organization = get_object_or_404(Organization, slug=organization_slug)

    leaders = User.objects.filter(leaderprofile__organization=organization)

    return render(
        request,
        "leader/index.html",
        {"leaders": leaders, "organization": organization},
    )


def leader_show(request, leader_id=None, leader_slug=None):
    """Leader details view."""

    if leader_id:
        leader = get_object_or_404(User, pk=leader_id)
    else:
        leader = get_object_or_404(User, slug=leader_slug)

    return render(request, "leader/show.html", {"leader": leader})
