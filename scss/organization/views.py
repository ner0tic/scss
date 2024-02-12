""" Organization Related Views. """

from django.contrib.auth import authenticate, login
from django.shortcuts import get_object_or_404, redirect, render

from .forms import OrganizationForm
from .models import Organization


def organization_index(request):
    """ Organization list view. """
    organizations = Organization.objects.all()

    return render(request, "organization/list.html", {"organizations": organizations})


def organization_index_root(request):
    """ Root Organization list view."""
    organizations = Organization.objects.filter(parent__isnull=True)

    return render(request, "organization/list.html", {"organizations": organizations})


def organization_show(request, organization_id=None, organization_slug=None):
    """Organization details view."""
    if organization_id:
        organization = get_object_or_404(Organization, pk=organization_id)
    else:
        organization = get_object_or_404(Organization, slug=organization_slug)

    return render(request, "organization/show.html", {"organization": organization})


def organization_index_by_parent(request, organization_id=None, organization_slug=None):
    """ Organization list by parent view. """
    if organization_id:
        parent_org = get_object_or_404(Organization, pk=organization_id)
    else:
        parent_org = get_object_or_404(Organization, slug=organization_slug)

    child_organizations = Organization.objects.filter(parent=parent_org)

    return render(
        request,
        "list.html",
        {"parent_org": parent_org, "organizations": child_organizations},
    )
