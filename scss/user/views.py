""" Users Related Views. """
from faction.forms import AttendeeProfileForm, LeaderProfileForm
from faction.models import AttendeeProfile, LeaderProfile
from faction.widgets import AttendeeListWidget, LeaderListWidget
from facility.forms import FacultyProfileForm
from facility.models import FacultyProfile
from facility.widgets import FacultyListWidget
from address.forms import AddressForm


from django.shortcuts import render, redirect
from django.contrib import messages
from django.contrib.auth.forms import AuthenticationForm
from django.contrib.auth import login as _login, logout as _logout
from django.contrib.auth.decorators import login_required
from django.contrib.contenttypes.models import ContentType

from .forms import RegistrationForm
from .models import User

def register(request):
    """ Register a user.

    Args:
        request: The HTTP request object.

    Returns:
        If the request method is 'POST' and the registration form is valid, redirects to the
        'success_url' page.
        Otherwise, renders the 'signup.html' template with the registration form and other related
        forms.

    Raises:
        None.
    """
    def save_profile(user, form):
        """
Save a profile.

Args:
    user: The user object associated with the profile.
    form: The profile form.

Returns:
    The saved profile object.
"""
        profile = form.save(commit=False)
        profile.user = user
        profile.save()

        return profile


    def save_address(form, profile, ProfileModel):
        """ Save an address.
        Args:
            form: The address form.
            profile: The profile object associated with the address.
            ProfileModel: The model class of the profile.

        Returns:
            The saved address object.
        """
        address = form.save(commit=False)
        content_type = ContentType.objects.get_for_model(ProfileModel)
        address.content_type = content_type
        address.object_id = profile.pk
        address.save()

        return address


    if request.method == "POST":
        registration_form = RegistrationForm(request.POST)

        if registration_form.is_valid():
            new_user = User.objects.create_user(
                username=registration_form.cleaned_data["username"],
                email=registration_form.cleaned_data["email"],
                password=registration_form.cleaned_data["password"],
            )

            if registration_form.cleaned_data["user_type"] == "Attendee":
                attendee_form = AttendeeProfileForm(request.POST)
                address_form = AddressForm(request.POST)

                if attendee_form.is_valid() and address_form.is_valid():
                    attendee_profile = save_profile(new_user, attendee_form)
                    address = save_address(address_form, attendee_profile, AttendeeProfile)                    

                    return redirect("success_url")
                else:
                    for field, errors in [attendee_form.errors.items() + address_form]:
                        for error in errors:
                            messages.error(request, f"{field}: {error}")

            elif registration_form.cleaned_data["user_type"] == "Leader":
                leader_form = LeaderProfileForm(request.POST)
                address_form = AddressForm(request.POST)

                if leader_form.is_valid() and address_form.is_valid():
                    leader_profile = save_profile(new_user, leader_form)
                    address = save_address(address_form, leader_profile, LeaderProfile)

                    return redirect("success_url")
                else:
                    for field, errors in [leader_form.errors.items() + address_form]:
                        for error in errors:
                            messages.error(request, f"{field}: {error}")

            elif registration_form.cleaned_data["user_type"] == "Faculty":
                faculty_form = FacultyProfileForm(request.POST)
                address_form = AddressForm(request.POST)

                if faculty_form.is_valid() and address_form.is_valid():
                    faculty_profile = save_profile(new_user, faculty_form)
                    address = save_address(address_form, faculty_profile, FacultyProfile)

                    return redirect("success_url")
                else:
                    for field, errors in [faculty_form.errors.items() + address_form]:
                        for error in errors:
                            messages.error(request, f"{field}: {error}")

        else:
            for field, errors in registration_form.errors.items():
                for error in errors:
                    messages.error(request, f"{field}: {error}")

    else:
        registration_form = RegistrationForm()
        address_form = AddressForm()
        attendee_form = AttendeeProfileForm()
        leader_form = LeaderProfileForm()
        faculty_form = FacultyProfileForm()

    return render(
        request,
        "signup.html",
        {
            "form": registration_form,
            "attendee_form": attendee_form,
            "leader_form": leader_form,
            "faculty_form": faculty_form,
            "address_form": address_form,
        },
    )


def login_view(request):
    """ View for user login.
    Args:
        request: The HTTP request object.

    Returns:
        If the request method is 'POST' and the form is valid, logs in the user and redirects to
        the 'dashboard' page.
        Otherwise, renders the 'signin.html' template with the login form.
    """
    if request.method == "POST":
        form = AuthenticationForm(request, data=request.POST)

        if form.is_valid():
            user = form.get_user()
            _login(request, user)

            return redirect("dashboard")

        else:
            for field, errors in form.errors.items():
                for error in errors:
                    messages.error(request, f"{field}: {error}")

    else:
        form = AuthenticationForm()

    return render(request, "signin.html", {"form": form})


@login_required
def dashboard(request):
    """ Dashboard view for authenticated users.
    Args:
        request: The HTTP request object.

    Returns:
        If the user is authenticated and has an attendee profile, sets the 'user_type' context
        variable to 'ATTENDEE'.
        If the user is authenticated and has a leader profile, sets the 'user_type' context
        variable to 'LEADER'.
        If the user is authenticated and has a faculty profile, sets the 'user_type' context
        variable to 'FACULTY'.
        If the user is a superuser, redirects to the admin page.
        Otherwise, renders the 'dashboard.html' template with the appropriate context.
    """
    user = request.user
    context = {}

    # if hasattr(user, "attendee_profile"):
    if user.role == 'ATTENDEE':
        context["user_type"] = "ATTENDEE"

    # elif hasattr(user, "leader_profile"):
    elif user.role == 'LEADER':
        context["user_type"] = "LEADER"
        context["widgets"] = [
            AttendeeListWidget()
        ]

    # elif hasattr(user, "faculty_profile"):
    elif user.role == 'FACULTY':
        context["user_type"] = "FACULTY"

    if user.is_superuser:
        return redirect("/admin/")

    return render(request, "dashboard.html", context)


def logout(request):
    """ Logout the user.
    Args:
        request: The HTTP request object.

    Returns:
        Redirects to the 'home' page.
    """
    _logout(request)

    return redirect("home")


def settings(request):
    """ Render the account settings page.
    Args:
        request: The HTTP request object.

    Returns:
        Renders the 'settings.html' template.
    """
    return render(request, "settings.html")
