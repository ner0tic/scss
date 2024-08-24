# faction/views/leader.py

from rest_framework import viewsets

from django.shortcuts import render, get_object_or_404
from django.views.generic import (
    CreateView as _CreateView,
    UpdateView as _UpdateView,
    DeleteView as _DeleteView,
    DetailView as _DetailView,
)
from django.urls import reverse_lazy

from user.models import User
from user.mixins import AdminRequiredMixin
from organization.models.organization import Organization, OrganizationSettings, OrganizationLabels

from ..models.faction import Faction
from ..models.leader import LeaderProfile
from ..serializers import LeaderSerializer
from ..forms.leader import LeaderForm


class CreateView(AdminRequiredMixin, _CreateView):
    model = LeaderProfile
    form_class = LeaderForm
    template_name = "leader/form.html"
    success_url = reverse_lazy("leader_index")

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        context["action"] = "Create"
        return context


class EditView(AdminRequiredMixin, _UpdateView):
    model = LeaderProfile
    form_class = LeaderForm
    template_name = "leader/form.html"
    success_url = reverse_lazy("leader_index")

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        context["action"] = "Edit"
        return context


class PromoteView(AdminRequiredMixin, _UpdateView):
    model = LeaderProfile
    form_class = LeaderForm
    template_name = "leader/promote.html"
    success_url = reverse_lazy("leader_index")

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        context["action"] = "Promote"
        return context


class DeleteView(AdminRequiredMixin, _DeleteView):
    model = LeaderProfile
    template_name = "leader/confirm_delete.html"
    success_url = reverse_lazy("leader_index")

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        context["action"] = "Delete"
        return context


class ShowView(_DetailView):
    model = LeaderProfile
    template_name = "leader/show.html"

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        context["action"] = "Details"
        return context


class LeaderViewSet(viewsets.ModelViewSet):
    queryset = User.objects.filter(user_type="leader")
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


def leader_index_by_organization(request, organization_id=None, organization_slug=None):
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
