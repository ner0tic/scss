# faction/views/attendee.py

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
from ..models.attendee import AttendeeProfile
from ..serializers import AttendeeSerializer
from ..forms.attendee import AttendeeForm



class CreateView(AdminRequiredMixin, _CreateView):
    model = AttendeeProfile
    form_class = AttendeeForm
    template_name = "attendee/form.html"
    success_url = reverse_lazy("attendee_index")

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        context["action"] = "Create"
        return context


class EditView(AdminRequiredMixin, _UpdateView):
    model = AttendeeProfile
    form_class = AttendeeForm
    template_name = "attendee/form.html"
    success_url = reverse_lazy("attendee_index")

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        context["action"] = "Edit"
        return context


class PromoteView(AdminRequiredMixin, _UpdateView):
    model = AttendeeProfile
    form_class = AttendeeForm
    template_name = "attendee/promote.html"
    success_url = reverse_lazy("attendee_index")

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        context["action"] = "Promote"
        return context


class DeleteView(AdminRequiredMixin, _DeleteView):
    model = AttendeeProfile
    template_name = "attendee/confirm_delete.html"
    success_url = reverse_lazy("attendee_index")

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        context["action"] = "Delete"
        return context


class ShowView(_DetailView):
    model = AttendeeProfile
    template_name = "attendee/show.html"

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        context["action"] = "Details"
        return context


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
