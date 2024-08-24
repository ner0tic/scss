""" Users Related Views. """

import logging
from django.contrib import messages
from django.contrib.auth import login as _login, logout as _logout
from django.contrib.auth.views import LogoutView as _LogoutView, LoginView as _LoginView
from django.contrib.auth.forms import AuthenticationForm
from django.contrib.contenttypes.models import ContentType
from django.shortcuts import redirect
from django.contrib.auth.mixins import LoginRequiredMixin
from django.views.generic import TemplateView
from django.urls import reverse_lazy
from django.template import loader, TemplateDoesNotExist
from django.views.generic import TemplateView
from django.views.generic.edit import FormView
from django.views import View

# from address.forms import AddressForm
# from facility.forms import FacultyProfileForm
from facility.models.faculty import Faculty, FacultyProfile
from faction.forms.attendee import AttendeeProfileForm
from faction.forms.leader import LeaderProfileForm
from facility.forms.faculty import FacultyProfileForm
from faction.models.faction import Faction
from faction.models.leader import LeaderProfile
from faction.models.attendee import AttendeeProfile

from .forms import RegistrationForm
from .models import User


logger = logging.getLogger(__name__)


class LoginView(_LoginView):
    template_name = "auth/signin.html"
    form_class = AuthenticationForm
    success_url = reverse_lazy("dashboard")

    def form_valid(self, form):
        user = form.get_user()
        _login(self.request, user)
        return super().form_valid(form)

    def form_invalid(self, form):
        for field, errors in form.errors.items():
            for error in errors:
                messages.error(self.request, f"{field}: {error}")
        return super().form_invalid(form)


class RegisterView(FormView):
    template_name = "signup.html"
    form_class = RegistrationForm
    success_url = reverse_lazy("success_url")

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        context["attendee_form"] = AttendeeProfileForm(self.request.POST or None)
        context["leader_form"] = LeaderProfileForm(self.request.POST or None)
        context["faculty_form"] = FacultyProfileForm(self.request.POST or None)
        context["address_form"] = AddressForm(self.request.POST or None)
        return context

    def form_valid(self, form):
        user = User.objects.create_user(
            username=form.cleaned_data["username"],
            email=form.cleaned_data["email"],
            password=form.cleaned_data["password"],
        )
        user_type = form.cleaned_data["user_type"]

        if user_type == "Attendee":
            profile_form = AttendeeProfileForm(self.request.POST)
            ProfileModel = AttendeeProfile
        elif user_type == "Leader":
            profile_form = LeaderProfileForm(self.request.POST)
            ProfileModel = LeaderProfile
        elif user_type == "Faculty":
            profile_form = FacultyProfileForm(self.request.POST)
            ProfileModel = FacultyProfile

        address_form = AddressForm(self.request.POST)
        if profile_form.is_valid() and address_form.is_valid():
            profile = self.save_profile(user, profile_form)
            self.save_address(address_form, profile, ProfileModel)
            return super().form_valid(form)
        else:
            for field, errors in profile_form.errors.items():
                for error in errors:
                    messages.error(self.request, f"{field}: {error}")
            for field, errors in address_form.errors.items():
                for error in errors:
                    messages.error(self.request, f"{field}: {error}")
            return self.form_invalid(form)

    def save_profile(self, user, form):
        profile = form.save(commit=False)
        profile.user = user
        profile.save()
        return profile

    def save_address(self, form, profile, ProfileModel):
        address = form.save(commit=False)
        content_type = ContentType.objects.get_for_model(ProfileModel)
        address.content_type = content_type
        address.object_id = profile.pk
        address.save()
        return address


class LogoutView(_LogoutView):
    """Logout the user and redirect to the home page."""

    next_page = reverse_lazy("home")


class DashboardView(LoginRequiredMixin, TemplateView):
    template_name = None

    def dispatch(self, request, *args, **kwargs):
        # Redirect superusers to the admin panel
        if request.user.is_superuser:
            return redirect(reverse_lazy("admin:index"))
        return super().dispatch(request, *args, **kwargs)

    def get_template_names(self):
        user = self.request.user

        if not hasattr(user, "user_type") or not user.user_type:
            raise ValueError("User type is not defined for this user.")

        # Dynamically select the template based on user_type
        template_name = f"{user.user_type.lower()}/dashboard.html"
        logger.debug(f"Using template: {template_name}")

        # Check if the template exists
        try:
            loader.get_template(template_name)
        except TemplateDoesNotExist:
            logger.warning(
                f"Template {template_name} does not exist. Falling back to default."
            )
            template_name = "auth/dashboard.html"

        return [template_name]

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        user = self.request.user
        dashboard_items = {}

        # Breadcrumbs for navigation
        context["breadcrumbs"] = [{"name": "Dashboard", "url": "/dashboard"}]

        # Load role-specific context
        if user.user_type.lower() == "attendee":
            dashboard_items |= self.get_attendee_dashboard_items(user)
        elif user.user_type.lower() == "leader":
            dashboard_items |= self.get_leader_dashboard_items(user)
        elif user.user_type.lower() == "faculty":
            dashboard_items |= self.get_faculty_dashboard_items(user)

        sorted_dashboard_items = dict(
            sorted(dashboard_items.items(), key=lambda item: item[1]["priority"])
        )
        context["dashboard_items"] = sorted_dashboard_items

        # Log the final context for debugging
        logger.debug("Context before rendering: %s", context)

        return context

    # Attendee Items
    def get_attendee_dashboard_items(self, user):
        # Fetch attendee-specific data
        return {
            "schedule": {"data": self.get_attendee_schedule(user), "priority": 10},
            "announcements": {"data": self.get_announcements(user), "priority": 40},
            "resources": {"data": self.get_resources(user), "priority": 50},
        }

    # Faculty Leader Items
    def get_leader_dashboard_items(self, user):
        # Fetch leader-specific data
        context = {}

        if user.leaderprofile.is_admin:
            context = self.get_leader_admin_dashboard_items(user)

        context.update(
            {
                "faction_management": {
                    "data": self.get_faction_management_data(user),
                    "priority": 10,
                },
                "reports": {"data": self.get_reports(user), "priority": 40},
                "tasks": {"data": self.get_tasks(user), "priority": 50},
            }
        )

        return context

    def get_leader_admin_dashboard_items(self, user):
        return {}

    # Faculty Items
    def get_faculty_dashboard_items(self, user):
        # Fetch faculty-specific data
        context = {}

        if user.is_admin:
            context = self.get_faculty_admin_dashboard_items(user)

        context.update(
            {
                "class_enrollments": {
                    "data": self.get_faculty_class_enrollments(user),
                    "priority": 10,
                },
                "resources": {"data": self.get_resources(user), "priority": 20},
            }
        )

        return context

    def get_faculty_admin_dashboard_items(self, user):
        return {}

    # Data Methods ###################################################################################
    def get_faculty_class_enrollments(self, user):
        return ["class A", "class B"]

    # Placeholder methods for context data fetching
    def get_attendee_schedule(self, user):
        # Replace with real logic
        return ["Event 1", "Event 2"]

    def get_announcements(self, user):
        # Replace with real logic
        return ["Announcement 1", "Announcement 2"]

    def get_resources(self, user):
        # Replace with real logic
        return ["Resource 1", "Resource 2"]

    def get_faction_management_data(self, user):
        # Replace with real logic
        return ["Team Member 1", "Team Member 2"]

    def get_reports(self, user):
        # Replace with real logic
        return ["Report 1", "Report 2"]

    def get_tasks(self, user):
        # Replace with real logic
        return ["Task 1", "Task 2"]

    def get_classes(self, user):
        # Replace with real logic
        return ["Class 1", "Class 2"]

    def get_attendee_performance(self, user):
        # Replace with real logic
        return ["Student 1: A", "Student 2: B"]


class SettingsView(LoginRequiredMixin, TemplateView):
    template_name = "user/settings.html"
