""" Faction Related Views. """

from rest_framework import viewsets

from django.shortcuts import render, get_object_or_404

from organization.models import Organization

from ..models import Faction
from ..serializers import FactionSerializer


class FactionViewSet(viewsets.ModelViewSet):
    queryset = Faction.objects.all()
    serializer_class = FactionSerializer


def faction_index(request):
    """Faction list view."""

    factions = Faction.objects.all()

    return render(request, "faction/index.html", {"factions": factions})


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
        "faction/index.html",
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
        request, "faction/index.html", {"faction": faction, "factions": factions}
    )


def faction_show(request, faction_id=None, faction_slug=None):
    """Faction details view."""
    if faction_id:
        faction = get_object_or_404(Faction, pk=faction_id)
    else:
        faction = get_object_or_404(Faction, slug=faction_slug)

    return render(request, "faction/show.html", {"faction": faction})
