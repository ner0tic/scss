""" Users Related Views. """

import logging
from django.contrib import messages
from django.contrib.auth import login as _login, logout as _logout
from django.contrib.auth.decorators import login_required
from django.contrib.auth.forms import AuthenticationForm
from django.contrib.contenttypes.models import ContentType
from django.shortcuts import render, redirect
from django.contrib.auth.mixins import LoginRequiredMixin
from django.views.generic import TemplateView
from django.contrib.auth.views import LogoutView as _LogoutView, LoginView as _LoginView
from django.urls import reverse_lazy
from django.views import View
from django.views.generic.edit import FormView

# from address.forms import AddressForm
# from facility.forms import FacultyProfileForm
from facility.models.faculty import Faculty, FacultyProfile
from faction.forms.attendee import AttendeeProfileForm
from faction.forms.leader import LeaderProfileForm
from facility.forms import FacultyProfileForm
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

    def get_template_names(self):
        user = self.request.user
        self.template_name = f"{user.user_type.lower()}/dashboard.html"
        logger.debug(f"Using template: {self.template_name}")
        return [self.template_name]

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        user = self.request.user

        if user.is_superuser:
            return redirect(reverse_lazy("admin:index"))

        context["breadcrumbs"] = [{"name": "Dashboard", "url": "/dashboard"}]

        try:
            # Log the context for debugging
            logger.debug("Context before rendering: %s", context)
        except Exception as e:
            logger.error("Error in context data: %s", e)
            raise

        return context


class SettingsView(LoginRequiredMixin, TemplateView):
    template_name = "user/settings.html"
