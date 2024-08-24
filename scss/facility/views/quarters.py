# facility/views/quarters.py

from django.urls import reverse_lazy
from django.views.generic import (
    ListView as _ListView,
    CreateView as _CreateView,
    UpdateView as _UpdateView,
    DeleteView as _DeleteView,
    DetailView as _DetailView,
)
from django.contrib.auth.mixins import LoginRequiredMixin, UserPassesTestMixin
from facility.models.quarters import Quarters, QuartersType
from facility.models.facility import Facility
from organization.models.organization import Organization


class IndexView(LoginRequiredMixin, _ListView):
    model = Quarters
    template_name = "quarters/index.html"
    context_object_name = "quarters_list"

    def get_queryset(self):
        return Quarters.objects.filter(
            facility__organization=self.request.user.get_profile().organization
        )

class IndexByFacilityView(LoginRequiredMixin, _ListView):
    model = Quarters
    template_name = 'quarters/index.html'
    context_object_name = 'quarters_list'

    def get_queryset(self):
        facility = get_object_or_404(Facility, slug=self.kwargs.get('slug'))
        return Quarters.objects.filter(facility=facility)

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        context['facility'] = get_object_or_404(Facility, slug=self.kwargs.get('slug'))
        return context

class IndexByQuartersTypeView(LoginRequiredMixin, _ListView):
    model = Quarters
    template_name = "quarters/index.html"
    context_object_name = "quarters_list"

    def get_queryset(self):
        quarters_type = get_object_or_404(QuartersType, slug=self.kwargs.get("slug"))
        return Quarters.objects.filter(type=quarters_type)

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        context["quarters_type"] = get_object_or_404(
            QuartersType, slug=self.kwargs.get("slug")
        )
        return context


class ShowView(LoginRequiredMixin, _DetailView):
    model = Quarters
    template_name = "quarters/show.html"
    context_object_name = "quarters"


class CreateView(LoginRequiredMixin, UserPassesTestMixin, _CreateView):
    model = Quarters
    template_name = "quarters/form.html"
    fields = ["name", "description", "capacity", "type", "facility"]
    success_url = reverse_lazy("facility:quarters_index")

    def test_func(self):
        return self.request.user.user_type == "FACULTY" and self.request.user.is_admin


class UpdateView(LoginRequiredMixin, UserPassesTestMixin, _UpdateView):
    model = Quarters
    template_name = "quarters/form.html"
    fields = ["name", "description", "capacity", "type", "facility"]
    success_url = reverse_lazy("facility:quarters:index")

    def test_func(self):
        return self.request.user.user_type == "FACULTY" and self.request.user.is_admin


class DeleteView(LoginRequiredMixin, UserPassesTestMixin, _DeleteView):
    model = Quarters
    template_name = "quarters/confirm_delete.html"
    success_url = reverse_lazy("facility:quarters:index")

    def test_func(self):
        return self.request.user.user_type == "FACULTY" and self.request.user.is_admin


class QuartersTypeIndexView(LoginRequiredMixin, _ListView):
    model = QuartersType
    template_name = "quarters_type/index.html"
    context_object_name = "quarters_type_list"

    def get_queryset(self):
        return QuartersType.objects.filter(
            organization=self.request.user.get_profile().organization
        )


class QuartersTypeShowView(LoginRequiredMixin, _DetailView):
    model = QuartersType
    template_name = "quarters_type/show.html"
    context_object_name = "quarters_type"


class QuartersTypeCreateView(LoginRequiredMixin, UserPassesTestMixin, _CreateView):
    model = QuartersType
    template_name = "quarters_type/form.html"
    fields = ["name", "description", "organization"]
    success_url = reverse_lazy("facility:quarters_type:index")

    def test_func(self):
        return self.request.user.user_type == "FACULTY" and self.request.user.is_admin


class QuartersTypeUpdateView(LoginRequiredMixin, UserPassesTestMixin, _UpdateView):
    model = QuartersType
    template_name = "quarters_type/form.html"
    fields = ["name", "description", "organization"]
    success_url = reverse_lazy("facility:quarters_type:index")

    def test_func(self):
        return self.request.user.user_type == "FACULTY" and self.request.user.is_admin


class QuartersTypeDeleteView(LoginRequiredMixin, UserPassesTestMixin, _DeleteView):
    model = QuartersType
    template_name = "quarters_type/confirm_delete.html"
    success_url = reverse_lazy("facility:quarters_type:index")

    def test_func(self):
        return self.request.user.user_type == "FACULTY" and self.request.user.is_admin


class QuartersTypeIndexByOrganizationView(LoginRequiredMixin, _ListView):
    model = QuartersType
    template_name = "facility/quarters_type/index.html"
    context_object_name = "quarters_type_list"

    def get_queryset(self):
        organization = get_object_or_404(Organization, slug=self.kwargs.get("slug"))
        return QuartersType.objects.filter(organization=organization)

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        context["organization"] = get_object_or_404(
            Organization, slug=self.kwargs.get("slug")
        )
        return context
