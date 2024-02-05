""" Organization Related Views. """
from django.shortcuts import get_object_or_404,render, redirect
from django.core.exceptions import ValidationError
from .forms import OrganizationForm
from .models import Organization

def create_organization(request):
    if request.method == "POST":
        form = OrganizationForm(request.POST)
        if form.is_valid():
            try:
                form.save()
                return redirect("some_success_url")
            except ValidationError as e:
                form.add_error(None, e)
    else:
        form = OrganizationForm()

    return render(request, "organizations/create.html", {"form": form})

def root_index(request):
    """ List of parent-less organizations. """
    organizations = Organization.objects.filter(parent__isnull=True)
    return render(request, 'list.html', {'organizations': organizations})


def show(request, org_id=None, org_slug=None):
    """ Organization Details. """
    if org_id:
        organization = get_object_or_404(Organization, pk=org_id)
    else:
        organization = get_object_or_404(Organization, slug=org_slug)
    return render(request, 'show.html', {'organization': organization})

def index_by_parent(request, org_id=None, org_slug=None):
    # Fetch the parent organization to ensure it exists
    if org_id:
        parent_org = get_object_or_404(Organization, pk=org_id)
    else:
        parent_org = get_object_or_404(Organization, slug=org_slug)

    child_organizations = Organization.objects.filter(parent=parent_org)

    # Render the list with the queried organizations
    return render(request, 'list.html', {
        'parent_org': parent_org,
        'organizations': child_organizations
    })
