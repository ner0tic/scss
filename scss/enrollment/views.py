""" Enrollment Related Views. """
from datetime import datetime
from django.shortcuts import get_object_or_404, render, redirect
from django.contrib.auth import login, authenticate
from django.utils.timezone import make_aware
from django.db.models import Q

from organization.models import Organization
from facility.models import Facility, Faculty
from faction.models import Faction, Attendee, Leader
from .models import *


##########################################
# Organization Enrollment Related Views. #
##########################################
def organization_enrollment_index(request):
    """
    Renders the list of organization enrollments.

    Args:
        request: The HTTP request object.

    Returns:
        The rendered HTTP response containing the list of organization enrollments.
    """

    enrollments = OrganizationEnrollment.objects.all()

    return render(
        request,
        "organization_enrollment/list.html",
        {"organization_enrollments": enrollments},
    )


def organization_enrollment_index_by_organization(
    request, organization_id=None, organization_slug=None
):
    if organization_id:
        organization = get_object_or_404(Organization, id=organization_id)
    else:
        organization = get_object_or_404(Organization, slug=organization_slug)

    enrollments = OrganizationEnrollment.objects.filter(organization_id=organization.id)

    return render(
        request,
        "organization_enrollment/list",
        {"organization_enrollments": enrollments, "organization": organization},
    )


def organization_enrollment_index_by_year(request, year):
    # Create aware datetime objects for the start and end of the year
    start_of_year = make_aware(datetime(year=int(year), month=1, day=1))
    end_of_year = make_aware(
        datetime(year=int(year), month=12, day=31, hour=23, minute=59, second=59)
    )

    enrollments = OrganizationEnrollment.objects.filter(
        Q(start_timestamp__gte=start_of_year) & Q(end_timestamp__lte=end_of_year)
    )

    return render(
        request,
        "organization_enrollment/list.html",
        {"organization_enrollments": enrollments, "year": year},
    )


######################################
# Facility Enrollment Related Views. #
######################################
def facility_enrollment_index(request):
    enrollments = FacilityEnrollment.objects.all()

    return render(
        request,
        "facility_enrollment/list.html",
        {"facility_enrollments": enrollments},
    )


def facility_enrollment_index_by_facility(
    request, facility_id=None, facility_slug=None
):
    if facility_id:
        facility = get_object_or_404(Facility, id=facility_id)
    else:
        facility = get_object_or_404(Facility, slug=facility_slug)

    enrollments = FacilityEnrollment.objects.filter(facility_id=facility.id)

    return render(
        request,
        "facility_enrollment/list.html",
        {"facility_enrollments": enrollments, "facility": facility},
    )


#####################################
# Faction Enrollment Related Views. #
#####################################
def faction_enrollment_show(
    request, faction_enrollment_id=None, faction_enrollment_slug=None
):
    if faction_enrollment_id:
        faction_enrollment = get_object_or_404(
            FactionEnrollment, pk=faction_enrollment_id
        )
    else:
        faction_enrollment = get_object_or_404(
            FactionEnrollment, slug=faction_enrollment_slug
        )

    return render(
        request,
        "faction_enrollment/list.html",
        {"faction_enrollment": faction_enrollment},
    )


def faction_enrollment_index(request):
    enrollments = FactionEnrollment.objects.all()

    return render(
        request,
        "faction_enrollment/list.html",
        {"faction_enrollments": enrollments}
    )


####################################
# Leader Enrollment Related Views. #
####################################
def leader_enrollment_index(request):
    pass


#######################
# Week Related Views. #
#######################
def week_index(request):
    pass


#########################
# Period Related Views. #
#########################
def period_index(request):
    pass


######################################
# Organization Course Related Views. #
######################################
def organization_course_index(request):
    pass


#################################
# Facility Class Related Views. #
#################################
def facility_class_index(request):
    pass


############################################
# Facility Class Enrollment Related Views. #
############################################
def facility_class_enrollment_index(request):
    pass


######################################
# Attendee Enrollment Related Views. #
######################################
def attendee_enrollment_index(request):
    pass


############################################
# Attendee Class Enrollment Related Views. #
############################################
def attendee_class_enrollment_index(request):
    pass


###########################################
# Faculty Class Enrollment Related Views. #
###########################################
def faculty_class_enrollment_index(request):
    pass


####################################
# Active Enrollment Related Views. #
####################################
def active_enrollment_index(request):
    pass
