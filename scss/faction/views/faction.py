# faction/views/faction.py

from rest_framework import viewsets
from django.shortcuts import render, redirect, get_object_or_404
from django.contrib.auth.mixins import LoginRequiredMixin, UserPassesTestMixin
from django.views import View
from django.urls import reverse
from django.views.generic import (
    CreateView as _CreateView,
    UpdateView as _UpdateView,
    DeleteView as _DeleteView,
    DetailView as _DetailView,
)
from django.urls import reverse_lazy

from user.models import User
from user.mixins import AdminRequiredMixin
from organization.models.organization import Organization
from organization.utils import get_user_organization_labels

from ..models.faction import Faction
from ..models.attendee import AttendeeProfile
from ..models.leader import LeaderProfile
from ..forms.attendee import AttendeeProfileForm
from ..forms.leader import LeaderProfileForm
from ..forms.faction import FactionForm
from ..serializers import FactionSerializer


class MyFactionView(LoginRequiredMixin, UserPassesTestMixin, View):
    template_name = "faction/manage.html"

    def test_func(self):
        return self.request.user.is_admin and self.request.user.user_type == "LEADER"

    def get(self, request, *args, **kwargs):
        user = request.user
        profile = user.leaderprofile
        faction = profile.faction

        attendee_form = AttendeeProfileForm()
        leader_form = LeaderProfileForm()
        faction_form = FactionForm(instance=faction)

        attendees = AttendeeProfile.objects.for_faction(faction)
        leaders = LeaderProfile.objects.filter(faction=faction)
        sub_factions = Faction.objects.filter(parent=faction).with_member_count()

        labels = get_user_organization_labels(user)

        tables = {
            labels["attendee_label"]: {
                "headers": ["First Name", "Last Name"],
                "rows": [[a.user.first_name, a.user.last_name] for a in attendees],
                "icon": "fa-user-plus",
                "url": reverse("attendee_new", kwargs={"faction_slug": faction.slug}),
                "actions": [
                    {
                        "name": "Edit",
                        "icon": "fas fa-pen-to-square",
                        "url_name": "attendee_edit",
                    },
                    {
                        "name": "Enroll",
                        "icon": "fas fa-calendar-plus",
                        "url_name": "attendee_enrollment_new",
                    },
                    {
                        "name": "Remove",
                        "icon": "fas fa-trash-can",
                        "url_name": "attendee_delete",
                    },
                    {"name": "View", "icon": "fas fa-eye", "url_name": "attendee_show"},
                ],
            },
            labels["leader_label"]: {
                "headers": ["First Name", "Last Name", "Admin"],
                "rows": [
                    [l.user.first_name, l.user.last_name, l.user.is_admin]
                    for l in leaders
                ],
                "icon": "fa-user-plus",
                "url": reverse("leader_new", kwargs={"faction_slug": faction.slug}),
                "actions": [
                    {
                        "name": "Edit",
                        "icon": "fas fa-pen-to-square",
                        "url_name": "leader_edit",
                    },
                    {
                        "name": "Enroll",
                        "icon": "fas fa-calendar-plus",
                        "url_name": "leader_enrollment_new",
                    },
                    {
                        "name": "Remove",
                        "icon": "fas fa-trash-can",
                        "url_name": "leader_delete",
                    },
                    {"name": "View", "icon": "fas fa-eye", "url_name": "leader_show"},
                    {
                        "name": "Promote",
                        "icon": "fas fa-person-arrow-up-from-line",
                        "url_name": "leader_promote",
                    },
                ],
            },
            labels["sub_faction_label"]: {
                "headers": ["Name", "Member Count"],
                "rows": [[f.name, f.member_count] for f in sub_factions],
                "icon": "fa-square-plus",
                "url": reverse("faction_new", kwargs={"faction_slug": faction}),
                "actions": [
                    {
                        "name": "Edit",
                        "icon": "fas fa-pen-to-square",
                        "url_name": "faction_edit",
                    },
                    #                    {'name': 'Enroll', 'icon': 'fas fa-calendar-plus', 'url_name': 'faction_enrollment_new'},
                    {
                        "name": "Remove",
                        "icon": "fas fa-trash-can",
                        "url_name": "faction_delete",
                    },
                    {"name": "View", "icon": "fas fa-eye", "url_name": "faction_show"},
                ],
            },
        }

        context = {
            "faction": faction,
            "attendees": attendees,
            "leaders": leaders,
            "sub_factions": sub_factions,
            "attendee_form": attendee_form,
            "leader_form": leader_form,
            "faction_form": faction_form,
            "tables": tables,
            "breadcrumbs": [
                {"name": "Dashboard", "url": "/dashboard"},
                {"name": "My Faction", "url": "/my-faction"},
            ],
        }

        return render(request, self.template_name, context)

    def post(self, request, *args, **kwargs):
        user = request.user
        profile = user.leaderprofile
        faction = profile.faction

        if "attendee" in request.POST:
            attendee_form = AttendeeProfileForm(request.POST)
            if attendee_form.is_valid():
                attendee_form.save()
                return redirect("my_faction")

        elif "leader" in request.POST:
            leader_form = LeaderProfileForm(request.POST)
            if leader_form.is_valid():
                leader_form.save()
                return redirect("my_faction")

        elif "faction" in request.POST:
            faction_form = FactionForm(request.POST, instance=faction)
            if faction_form.is_valid():
                faction_form.save()
                return redirect("my_faction")

        attendees = AttendeeProfile.objects.filter(faction=faction)
        leaders = LeaderProfile.objects.filter(faction=faction)
        sub_factions = Faction.objects.filter(parent=faction)

        context = {
            "faction": faction,
            "attendees": attendees,
            "leaders": leaders,
            "sub_factions": sub_factions,
            "attendee_form": attendee_form,
            "leader_form": leader_form,
            "faction_form": faction_form,
        }

        return render(request, self.template_name, context)


class CreateView(AdminRequiredMixin, _CreateView):
    model = Faction
    form_class = FactionForm
    template_name = "faction/form.html"
    success_url = reverse_lazy("faction_index")

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        context["action"] = "Create"
        return context


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
