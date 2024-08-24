# facility/views/facility.py

from django.urls import reverse_lazy
from django.views.generic import (
    ListView as _ListView,
    CreateView as _CreateView,
    UpdateView as _UpdateView,
    DeleteView as _DeleteView,
    DetailView as _DetailView,
)
from django.shortcuts import get_object_or_404
from django.contrib.auth.mixins import LoginRequiredMixin, UserPassesTestMixin
from django.views.generic import TemplateView

from organization.models.organization import Organization
from enrollment.models.organization import OrganizationCourse
from enrollment.models.temporal import Week, Period
from enrollment.models.facility import FacilityEnrollment, FacilityClass


from ..models import Facility, Department, Quarters
from ..forms.facility import FacilityForm


class IndexView(_ListView):
    model = Facility
    template_name = "facility/index.html"
    context_object_name = "facilities"


class IndexByOrganizationView(_ListView):
    model = Facility
    template_name = "facility/index.html"
    context_object_name = "facilities"

    def get_queryset(self):
        # Allow lookup by pk or slug
        organization_lookup = self.kwargs.get("organization_pk") or self.kwargs.get(
            "organization_slug"
        )

        # Check if the lookup is a digit (assume it's a pk if so)
        if organization_lookup.isdigit():
            organization = get_object_or_404(Organization, pk=organization_lookup)
        else:
            organization = get_object_or_404(Organization, slug=organization_lookup)

        return Facility.objects.filter(organization=organization)

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        organization_lookup = self.kwargs.get("organization_pk") or self.kwargs.get(
            "organization_slug"
        )

        if organization_lookup.isdigit():
            organization = get_object_or_404(Organization, pk=organization_lookup)
        else:
            organization = get_object_or_404(Organization, slug=organization_lookup)

        context["organization"] = organization
        return context


class ManageView(LoginRequiredMixin, UserPassesTestMixin, TemplateView):
    template_name = "facility/manage.html"

    def test_func(self):
        # Check if the user is a faculty member with is_admin set to true
        return self.request.user.user_type == "FACULTY" and self.request.user.is_admin

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        user = self.request.user

        # Get the associated facility for the user
        facility = get_object_or_404(Facility, faculty__user=user)
        context["facility"] = facility

        # Fetch related data to be displayed in the management view
        context["departments"] = Department.objects.filter(facility=facility)
        context["quarters"] = Quarters.objects.filter(facility=facility)
        context["classes"] = FacilityClass.objects.filter(
            facility_enrollment__facility=facility
        )
        context["enrollments"] = FacilityEnrollment.objects.filter(facility=facility)
        context["courses"] = OrganizationCourse.objects.filter(
            organization_enrollment__organization=facility.organization
        )
        context["weeks"] = Week.objects.filter(facility_enrollment__facility=facility)
        context["periods"] = Period.objects.filter(
            week__facility_enrollment__facility=facility
        )

        return context


class ShowView(_DetailView):
    model = Facility
    template_name = "facility/show.html"
    context_object_name = "facility"


class CreateView(_CreateView):
    model = Facility
    form_class = FacilityForm
    template_name = "facility/form.html"
    success_url = reverse_lazy("facility_index")


class UpdateView(_UpdateView):
    model = Facility
    form_class = FacilityForm
    template_name = "facility/form.html"
    success_url = reverse_lazy("facility_index")


class DeleteView(_DeleteView):
    model = Facility
    template_name = "facility/confirm_delete.html"
    success_url = reverse_lazy("facility_index")
