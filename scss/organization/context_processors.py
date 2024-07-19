# organization/context_processors.py

from .models import Organization

def organization_labels(request):
    if request.user.is_authenticated:
        user_organization = {}
        if user_profile := request.user.get_profile():
            user_organization = user_profile.organization
        labels = user_organization.labels if user_organization else None
    else:
        labels = None

    return {
        'organization_labels': labels,
    }
