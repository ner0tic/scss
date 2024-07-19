""" Enrollment Related Views. """

from datetime import datetime

from django.contrib.auth import authenticate, login
from django.contrib.auth.decorators import login_required
from django.db.models import Q
from django.shortcuts import get_object_or_404, redirect, render
from django.utils.timezone import make_aware

from facility.models.facility import Facility
from facility.models.faculty import Faculty
from faction.models.attendee import Attendee
from faction.models.faction import Faction
from faction.models.leader import Leader
from organization.models import Organization

from .models.enrollment import *
from .models.facility import *
from .models.faction import *
from .models.organization import *


@login_required
def my_enrollments(request):
    if request.user.role in ["ATTENDEE", "LEADER"]:
        return redirect("faction_enrollment_index_by_current_user")
    else:
        return redirect("faculty_enrollment_index_by_current_user")


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
        request, "faction_enrollment/list.html", {"faction_enrollments": enrollments}
    )


def faction_enrollment_index_by_year(request, year=None):
    year = year or datetime.now().year
    enrollments = FactionEnrollment.objects.filter(
        Q(start_timestamp__year=year) | Q(end_timestamp__year=year)
    )

    return render(
        request,
        "faction_enrollment/list.html",
        {"faction_enrollments": enrollments, "year": year},
    )


def faction_enrollment_index_by_faction(request, faction_id=None, faction_slug=None):
    if faction_id:
        faction = get_object_or_404(Faction, id=faction_id)
    else:
        faction = get_object_or_404(Faction, slug=faction_slug)

    enrollments = FactionEnrollment.objects.filter(faction=faction)

    return render(
        request,
        "faction-enrollment/list.html",
        {"faction_enrollments": enrollments, "faction": faction},
    )


def faction_enrollment_index_by_year_and_faction(
    request, year=None, faction_id=None, faction_slug=None
):
    year = year or datetime.now().year
    if faction_id:
        faction = get_object_or_404(Faction, id=faction_id)
    else:
        faction = get_object_or_404(Faction, slug=faction_slug)

    enrollments = FactionEnrollment.objects.filter(faction=faction).filter(
        Q(start_timestamp__year=year) | Q(end_timestamp__year=year)
    )

    return render(
        request,
        "faction-enrollment/list.html",
        {"faction_enrollments": enrollments, "faction": faction, "year": year},
    )


def faction_enrollment_index_by_current_user(request):
    user = request.user
    print(user)
    faction = 0
    profile = user.get_profile()
    
    if hasattr(profile, "faction"):
        print("has attribute.")
        faction = user.get_profile().faction

    print(faction)
    enrollments = FactionEnrollment.objects.by_faction(faction_id=faction.id)
    
    return render(
        request,
        "faction-enrollment/list.html",
        {"enrollments": enrollments, "faction": faction},
    )


####################################
# Leader Enrollment Related Views. #
####################################
def leader_enrollment_index(request):
    pass


def leader_enrollment_index_by_faction_enrollment(
    request,
    faction_id=None,
    faction_slug=None,
    faction_enrollment_id=None,
    faction_enrollment_slug=None,
):
    # get list of leader enrollments using the faction enrollment id/ slug
    if faction_enrollment_id:
        faction_enrollment = FactionEnrollment.objects.get(id=faction_enrollment_id)
    else:
        faction_enrollment = FactionEnrollment.objects.get(slug=faction_enrollment_slug)

    enrollments = LeaderEnrollment.objects.by_faction_enrollment(faction_enrollment)

    return render(
        request,
        "leader-enrollment/list.html",
        {"enrollments": enrollments, "faction_enrollment": faction_enrollment},
    )


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


def attendee_enrollment_index_by_faction_enrollment(
    request,
    faction_id=None,
    faction_slug=None,
    faction_enrollment_id=None,
    faction_enrollment_slug=None,
):
    # get list of attendee enrollments using the faction enrollment id/ slug
    if faction_enrollment_id:
        faction_enrollment = FactionEnrollment.objects.get(id=faction_enrollment_id)
    else:
        faction_enrollment = FactionEnrollment.objects.get(slug=faction_enrollment_slug)

    enrollments = AttendeeEnrollment.objects.by_faction_enrollment(faction_enrollment)

    return render(
        request,
        "attendee-enrollment/list.html",
        {"enrollments": enrollments, "faction_enrollment": faction_enrollment},
    )


############################################
# Attendee Class Enrollment Related Views. #
############################################
def attendee_class_enrollment_index(request):
    pass

def attendee_class_enrollment_index_by_attendee_enrollment(
    request,
    attendee_id = None,
    attendee_slug = None,
    enrollment_id = None,
    enrollment_slug = None):

    # Get list of attendee class enrollments using the 
    # attendee enrollment id/ slug
    if enrollment_id:
        enrollment = AttendeeEnrollment.objects.get(id=enrollment_id)
    else:
        enrollment = AttendeeEnrollment.objects.get(slug=enrollment_slug)

    enrollments = AttendeeClassEnrollment.objects.by_attendee_enrollment(enrollment)

    return render(
        request,
        "attendee-enrollment/list.html",
        {"enrollments": enrollments, "attendee_class_enrollment": enrollment},
    )

def my_schedule(request):
    user = request.user
    enrollment = ActiveEnrollment.objects.get(user_id=user.id)

    if user.role == 'ATTENDEE':
        page = 'attendee-class-enrollment/list.html'
        enrollments = AttendeeClassEnrollment.objects.get(attendee_enrollment_id=enrollment.id)
    elif user.role == 'LEADER':
        page = 'leader-enrollment/list.html'
        enrollments = LeaderEnrollment.objects.get(id=enrollment.leader_enrollment_id)
    elif user.role == 'FACULTY':
        page = 'faculty-class-enrollment/list.html'
        enrollments = FacultyClassEnrollment.objects.filter(faculty_id=enrollment.facility_id, facility_enrollment_id=enrollment.facility_enrollment.id)
    
    return render(request, page, {'enrollment': enrollment, 'enrollments': enrollments})
###########################################
# Faculty Class Enrollment Related Views. #
###########################################
def faculty_class_enrollment_index(request):
    pass


####################################
# Active Enrollment Related Views. #
####################################
def my_enrollments(request):
    user = request.user
    enrollments = []

    if user.role == "ATTENDEE":
        enrollments = AttendeeEnrollment.objects.filter(attendee=user)
        user_type = "attendee"
    if user.role == "LEADER":
        enrollments = LeaderEnrollment.objects.filter(leader=user)
        user_type = "leader"
    if user.role == "FACULTY":
        enrollments = FacultyEnrollment.objects.filter(faculty=user)
        user_type = "faculty"

    return render(
        request, f"{user_type}-enrollment/list.html", {"enrollments": enrollments}
    )


def active_enrollment_index(request):
    user = request.user

    active_enrollment = get_object_or_404(ActiveEnrollment, user=user)

    return render(
        request, "active-enrollment/list.html", {"active_enrollment": active_enrollment}
    )
