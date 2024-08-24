# organization/views/organization.py

from rest_framework import viewsets
from django.shortcuts import get_object_or_404
from django.urls import reverse_lazy
from django.views.generic import (
    ListView as _ListView,
    DetailView as _DetailView,
    CreateView as _CreateView,
    UpdateView as _UpdateView,
    DeleteView as _DeleteView,
)
from django.contrib.auth.mixins import LoginRequiredMixin, PermissionRequiredMixin

from ..models.organization import Organization
from ..forms.organization import OrganizationForm
from ..serializers import OrganizationSerializer


class ListView(LoginRequiredMixin, _ListView):
    """Organization list view."""

    model = Organization
    template_name = "organization/index.html"
    context_object_name = "organizations"

    def get_queryset(self):
        return Organization.objects.all()


class RootListView(LoginRequiredMixin, _ListView):
    """Root Organization list view."""

    model = Organization
    template_name = "organization/index.html"
    context_object_name = "organizations"

    def get_queryset(self):
        return Organization.objects.filter(parent__isnull=True)


class DetailView(LoginRequiredMixin, _DetailView):
    """Organization details view."""

    model = Organization
    template_name = "organization/show.html"
    context_object_name = "organization"

    def get_object(self):
        organization_id = self.kwargs.get("organization_id")
        organization_slug = self.kwargs.get("organization_slug")
        if organization_id:
            return get_object_or_404(Organization, pk=organization_id)
        else:
            return get_object_or_404(Organization, slug=organization_slug)


class ListByParentView(LoginRequiredMixin, _ListView):
    """Organization list by parent view."""

    model = Organization
    template_name = "organization/index.html"
    context_object_name = "organizations"

    def get_queryset(self):
        organization_id = self.kwargs.get("organization_id")
        organization_slug = self.kwargs.get("organization_slug")
        if organization_id:
            parent_org = get_object_or_404(Organization, pk=organization_id)
        else:
            parent_org = get_object_or_404(Organization, slug=organization_slug)
        return Organization.objects.filter(parent=parent_org)

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        organization_id = self.kwargs.get("organization_id")
        organization_slug = self.kwargs.get("organization_slug")
        if organization_id:
            context["parent_org"] = get_object_or_404(Organization, pk=organization_id)
        else:
            context["parent_org"] = get_object_or_404(
                Organization, slug=organization_slug
            )
        return context


class CreateView(LoginRequiredMixin, _CreateView):
    model = Organization
    form_class = OrganizationForm
    template_name = "organization/form.html"
    success_url = reverse_lazy(
        "organization_index"
    )  # Redirect to the organization list view after successful creation

    def form_valid(self, form):
        form.instance.created_by = (
            self.request.user
        )  # Assuming you want to associate the organization with the user
        return super().form_valid(form)


class SubOrganizationCreateView(LoginRequiredMixin, _CreateView):
    model = Organization
    form_class = OrganizationForm
    template_name = "organization/form.html"

    def get_success_url(self):
        # Redirect to the parent organization's detail view after successful creation
        return reverse_lazy(
            "organization_show",
            kwargs={"organization_slug": self.kwargs["organization_slug"]},
        )

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        context["parent"] = self.get_parent_organization()
        return context

    def get_parent_organization(self):
        organization_slug = self.kwargs.get("organization_slug")
        return get_object_or_404(Organization, slug=organization_slug)

    def form_valid(self, form):
        parent_organization = self.get_parent_organization()
        form.instance.parent = parent_organization  # Set the parent organization
        form.instance.created_by = (
            self.request.user
        )  # Assuming you want to associate the organization with the user
        return super().form_valid(form)


class OrganizationViewSet(viewsets.ModelViewSet):
    queryset = Organization.objects.all()
    serializer_class = OrganizationSerializer
