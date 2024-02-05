""" Facility Related Views. """
from django.shortcuts import get_object_or_404, render, redirect
from django.contrib.auth import login, authenticate
from organization.models import Organization
from .forms import FacultyRegistrationForm
from .models import Facility, Faculty, Department, Quarters


def facility_index(request):
    """List of facilities."""
    facilities = Facility.objects.all()

    return render(request, "facility/list.html", {"facilities": facilities})


def facility_index_by_organization(request, organization_id=None, organization_slug=None):
    """List of facility by Organization."""
    if organization_id:
        organization = get_object_or_404(Organization, id=organization_id)
    else:
        organization = get_object_or_404(Organization, slug=organization_slug)

    facilities = Facility.objects.filter(organization_id=organization.id)

    return render(
        request,
        "facility/list.html",
        {"facilities": facilities, "organization": organization},
    )


def facility_show(request, facility_id=None, facility_slug=None):
    if facility_id:
        facility = get_object_or_404(Facility, pk=facility_id)
    else:
        facility = get_object_or_404(Facility, slug=facility_slug)

    return render(request, "facility/show.html", {"facility": facility})


##############################
### FACULTY RELATED ROUTES ###
##############################
def faculty_index(request):
    """List of faculty."""
    faculty = Faculty.objects.all()

    return render(request, "faculty/list.html", {"faculty": faculty})


def faculty_index_by_facility(request, facility_id=None, facililty_slug=None):
    """List of faculty by Facility."""
    if facility_id:
        facility = get_object_or_404(Facility, id=facility_id)
    else:
        facility = get_object_or_404(Facility, slug=facility_slug)

    faculty = Faculty.objects.filter(facility_id=facility.id)

    return render(
        request,
        "faculty/list.html",
        {"faculty": faculty, "facility": facility},
    )


def faculty_show(request, faculty_id=None, faculty_slug=None):
    if faculty_id:
        faculty = get_object_or_404(Faculty, pk=faculty_id)
    else:
        faculty = get_object_or_404(Faculty, slug=faculty_slug)

    return render(request, "faculty/show.html", {"faculty": faculty})


def register_faculty(request):
    """Faculty Registration View."""
    if request.method == "POST":
        form = FacultyRegistrationForm(request.POST)
        if form.is_valid():
            form.save()
            username = form.cleaned_data.get("username")
            raw_password = form.cleaned_data.get("password1")
            user = authenticate(username=username, password=raw_password)
            login(request, user)
            return redirect("home")  # Redirect to a home page or appropriate view
    else:
        form = FacultyRegistrationForm()
    return render(request, "register_faculty.html", {"form": form})


#################################
### DEPARTMENT RELATED ROUTES ###
#################################
def department_index(request):
    """List of department."""
    departments = Department.objects.all()

    return render(request, "department/list.html", {"departments": departments})


def department_index_by_facility(request, facility_id=None, facility_slug=None):
    """List of department by Facility."""
    if facility_id:
        facility = get_object_or_404(Facility, id=facility_id)
    else:
        facility = get_object_or_404(Facility, slug=facility_slug)

    departments = Department.objects.filter(facility_id=facility.id)

    return render(
        request,
        "department/list.html",
        {"departments": departments, "facility": facility},
    )


def department_show(request, department_id=None, department_slug=None):
    if department_id:
        department = get_object_or_404(Department, pk=department_id)
    else:
        department = get_object_or_404(Department, slug=department_slug)

    return render(request, "department/show.html", {"department": department})


###############################
### Quarters Related Views. ###
###############################
def quarters_index(request):
    """List of quarters."""
    quarters = Quarters.objects.all()

    return render(request, "quarters/list.html", {"quarters": quarters})


def quarters_index_by_facility(request, facility_id=None, facility_slug=None):
    """List of quarters by Facility."""
    if facility_id:
        facility = get_object_or_404(Facility, id=facility_id)
    else:
        facility = get_object_or_404(Facility, slug=facility_slug)

    quarters = Quarters.objects.filter(facility_id=facility.id)

    return render(
        request,
        "quarters/list.html",
        {"quarters": quarters, "facility": facility},
    )


def quarters_show(request, quarters_id=None, quarters_slug=None):
    if quarters_id:
        quarters = get_object_or_404(Quarters, pk=quarters_id)
    else:
        quarters = get_object_or_404(Quarters, slug=quarters_slug)

    return render(request, "quarters/show.html", {"quarters": quarters})
