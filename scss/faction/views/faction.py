""" Faction Related Views. """

from rest_framework import viewsets
from django.shortcuts import render, redirect, get_object_or_404
from django.contrib.auth.mixins import LoginRequiredMixin, UserPassesTestMixin
from django.views import View

from ..models import Faction, AttendeeProfile, LeaderProfile
from ..forms import AttendeeProfileForm, LeaderProfileForm, FactionForm
from organization.models import Organization
from user.models import User

from ..models.faction import Faction
from ..serializers import FactionSerializer


class MyFactionView(LoginRequiredMixin, UserPassesTestMixin, View):
    template_name = 'faction/manage.html'

    def test_func(self):
        return self.request.user.is_admin and self.request.user.user_type == 'LEADER'

    def get(self, request, *args, **kwargs):
        user = request.user
        profile = user.leaderprofile
        faction = profile.faction

        attendee_form = AttendeeProfileForm()
        leader_form = LeaderProfileForm()
        faction_form = FactionForm(instance=faction)

        attendees = AttendeeProfile.objects.filter(faction=faction)
        leaders = LeaderProfile.objects.filter(faction=faction)
        sub_factions = Faction.objects.filter(parent=faction)

        context = {
            'faction': faction,
            'attendees': attendees,
            'leaders': leaders,
            'sub_factions': sub_factions,
            'attendee_form': attendee_form,
            'leader_form': leader_form,
            'faction_form': faction_form,
            'breadcrumbs': [
                {'name': 'Dashboard', 'url': '/dashboard'},
                {'name': 'My Faction', 'url': '/my-faction'}
            ]
        }

        return render(request, self.template_name, context)

    def post(self, request, *args, **kwargs):
        user = request.user
        profile = user.leaderprofile
        faction = profile.faction

        if 'attendee' in request.POST:
            attendee_form = AttendeeProfileForm(request.POST)
            if attendee_form.is_valid():
                attendee_form.save()
                return redirect('my_faction')

        elif 'leader' in request.POST:
            leader_form = LeaderProfileForm(request.POST)
            if leader_form.is_valid():
                leader_form.save()
                return redirect('my_faction')

        elif 'faction' in request.POST:
            faction_form = FactionForm(request.POST, instance=faction)
            if faction_form.is_valid():
                faction_form.save()
                return redirect('my_faction')

        attendees = AttendeeProfile.objects.filter(faction=faction)
        leaders = LeaderProfile.objects.filter(faction=faction)
        sub_factions = Faction.objects.filter(parent=faction)

        context = {
            'faction': faction,
            'attendees': attendees,
            'leaders': leaders,
            'sub_factions': sub_factions,
            'attendee_form': attendee_form,
            'leader_form': leader_form,
            'faction_form': faction_form,
        }

        return render(request, self.template_name, context)


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
