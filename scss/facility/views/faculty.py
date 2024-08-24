# facility/views/faculty.py

from django.views.generic import (
    ListView as _ListView,
    CreateView as _CreateView,
    UpdateView as _UpdateView,
    DeleteView as _DeleteView,
    DetailView as _DetailView,
    FormView as _FormView,
)
from django.contrib.auth import authenticate, login
from django.urls import reverse_lazy
from django.shortcuts import get_object_or_404, redirect
from django.views.generic import TemplateView
from django.contrib.auth.mixins import LoginRequiredMixin, UserPassesTestMixin
from django.forms import modelformset_factory
from django.contrib import messages

from user.models import User
from user.mixins import AdminRequiredMixin
from organization.models.organization import Organization

from ..models.facility import Facility
from ..models.faculty import Faculty, FacultyProfile
from ..forms.faculty import (
    RegistrationForm,
    FacultyForm,
    PromoteFacultyForm,
    AssignDepartmentForm,
    AssignClassForm,
    ChangeQuartersForm,
)


class IndexView(_ListView):
    template_name = "faculty/index.html"
    context_object_name = "faculty"

    def get_queryset(self):
        return User.objects.filter(role="FACULTY")


class ManageView(LoginRequiredMixin, UserPassesTestMixin, TemplateView):
    template_name = "faculty/manage.html"

    def test_func(self):
        # Check if the user has the correct permissions (is admin and user_type is 'FACULTY')
        return self.request.user.user_type == "FACULTY" and self.request.user.is_admin

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)

        # Check if slug or pk is provided
        faculty_slug = self.kwargs.get("slug")
        faculty_pk = self.kwargs.get("pk")

        if faculty_slug or faculty_pk:
            # Get the specific faculty by slug or pk
            if faculty_slug:
                faculty = get_object_or_404(Faculty, slug=faculty_slug)
            else:
                faculty = get_object_or_404(Faculty, pk=faculty_pk)
            context["faculty"] = faculty

            # Add forms to the context for specific actions (e.g., promote, assign)
            context["faculty_form"] = FacultyForm(instance=faculty)
            context["promotion_form"] = PromoteFacultyForm(instance=faculty)
            context["department_form"] = AssignDepartmentForm(instance=faculty)
            context["class_form"] = ClassAssignmentForm(instance=faculty)
            context["quarters_form"] = QuartersAssignmentForm(instance=faculty)

        else:
            # No slug/pk provided, list all faculty associated with the current user's facility
            context["faculty_list"] = Faculty.objects.filter(
                facility=self.request.user.facultyprofile.facility
            )

        return context

    def post(self, request, *args, **kwargs):
        # Handle form submissions for specific faculty actions
        faculty_slug = self.kwargs.get("slug")
        faculty_pk = self.kwargs.get("pk")

        if faculty_slug or faculty_pk:
            if faculty_slug:
                faculty = get_object_or_404(Faculty, slug=faculty_slug)
            else:
                faculty = get_object_or_404(Faculty, pk=faculty_pk)

            if "promote_faculty" in request.POST:
                # Handle promotion form submission
                promotion_form = FacultyPromotionForm(request.POST, instance=faculty)
                if promotion_form.is_valid():
                    promotion_form.save()
                    return redirect(
                        reverse_lazy(
                            "faculty:faculty_manage", kwargs={"slug": faculty.slug}
                        )
                    )

            elif "assign_faculty" in request.POST:
                # Handle assignment form submission
                assignment_form = FacultyAssignmentForm(request.POST, instance=faculty)
                if assignment_form.is_valid():
                    assignment_form.save()
                    return redirect(
                        reverse_lazy(
                            "faculty:faculty_manage", kwargs={"slug": faculty.slug}
                        )
                    )

            elif "assign_department" in request.POST:
                # Handle department assignment form submission
                department_form = DepartmentAssignmentForm(
                    request.POST, instance=faculty
                )
                if department_form.is_valid():
                    department_form.save()
                    return redirect(
                        reverse_lazy(
                            "faculty:faculty_manage", kwargs={"slug": faculty.slug}
                        )
                    )

            elif "assign_class" in request.POST:
                # Handle class assignment form submission
                class_form = AssignClassForm(request.POST, instance=faculty)
                if class_form.is_valid():
                    class_form.save()
                    return redirect(
                        reverse_lazy(
                            "faculty:faculty_manage", kwargs={"slug": faculty.slug}
                        )
                    )

            elif "assign_quarters" in request.POST:
                # Handle quarters assignment form submission
                quarters_form = ChangeQuartersForm(request.POST, instance=faculty)
                if quarters_form.is_valid():
                    quarters_form.save()
                    return redirect(
                        reverse_lazy(
                            "faculty:faculty_manage", kwargs={"slug": faculty.slug}
                        )
                    )

        return super().post(request, *args, **kwargs)


class CreateView(AdminRequiredMixin, _CreateView):
    model = FacultyProfile
    form_class = FacultyForm
    template_name = "faculty/form.html"
    success_url = reverse_lazy("faculty_index")

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        context["action"] = "Create"
        return context


class EditView(AdminRequiredMixin, _UpdateView):
    model = FacultyProfile
    form_class = FacultyForm
    template_name = "faculty/form.html"
    success_url = reverse_lazy("faculty_index")

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        context["action"] = "Edit"
        return context


class PromoteView(AdminRequiredMixin, _UpdateView):
    model = FacultyProfile
    form_class = FacultyForm
    template_name = "faculty/promote.html"
    success_url = reverse_lazy("faculty_index")

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        context["action"] = "Promote"
        return context


class IndexByFacilityView(_ListView):
    model = Faculty
    template_name = "faculty/index.html"
    context_object_name = "faculty_list"

    def get_queryset(self):
        # Get the facility by either slug or pk, depending on what is provided in the URL
        facility_slug = self.kwargs.get("slug")
        facility_pk = self.kwargs.get("pk")

        if facility_slug:
            facility = get_object_or_404(Facility, slug=facility_slug)
        else:
            facility = get_object_or_404(Facility, pk=facility_pk)

        # Return the queryset filtered by the facility
        return Faculty.objects.filter(facility=facility)

    def get_context_data(self, **kwargs):
        # Get the facility to pass into context for display
        context = super().get_context_data(**kwargs)
        facility_slug = self.kwargs.get("slug")
        facility_pk = self.kwargs.get("pk")

        if facility_slug:
            facility = get_object_or_404(Facility, slug=facility_slug)
        else:
            facility = get_object_or_404(Facility, pk=facility_pk)

        context["facility"] = facility
        return context


class DeleteView(AdminRequiredMixin, _DeleteView):
    model = FacultyProfile
    template_name = "faculty/confirm_delete.html"
    success_url = reverse_lazy("faculty_index")

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        context["action"] = "Delete"
        return context


class UpdateView(_UpdateView):
    model = Faculty
    form_class = FacultyForm
    template_name = "faculty/form.html"
    success_url = reverse_lazy("faculty_index")


class IndexByOrganizationView(_ListView):
    model = Faculty
    template_name = "faculty/index.html"
    context_object_name = "faculties"

    def get_queryset(self):
        # Allow lookup by pk or slug
        organization_lookup = self.kwargs.get("organization_pk") or self.kwargs.get(
            "organization_slug"
        )

        # Check if the lookup is a digit (assume it's a pk if so)
        if organization_lookup.isdigit():
            organization = get_object_or_404(Organization, pk=organization_lookup)
        else:
            organization = get_object_or_404(Organization, slug=organization_lookup)

        return Faculty.objects.filter(organization=organization)

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        organization_lookup = self.kwargs.get("organization_pk") or self.kwargs.get(
            "organization_slug"
        )

        if organization_lookup.isdigit():
            organization = get_object_or_404(Organization, pk=organization_lookup)
        else:
            organization = get_object_or_404(Organization, slug=organization_lookup)

        context["organization"] = organization
        return context


class IndexByFacilityView(_ListView):
    template_name = "faculty/index.html"
    context_object_name = "faculty"

    def get_queryset(self):
        facility_id = self.kwargs.get("facility_id")
        facility_slug = self.kwargs.get("facility_slug")

        if facility_id:
            facility = get_object_or_404(Facility, id=facility_id)
        else:
            facility = get_object_or_404(Facility, slug=facility_slug)

        return Faculty.objects.filter(facultyprofile__facility_id=facility.id)

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        facility_id = self.kwargs.get("facility_id")
        facility_slug = self.kwargs.get("facility_slug")
        context["facility"] = (
            get_object_or_404(Facility, id=facility_id)
            if facility_id
            else get_object_or_404(Facility, slug=facility_slug)
        )
        return context


class IndexByFacilityView(_ListView):
    template_name = "faculty/index.html"
    context_object_name = "faculty"

    def get_queryset(self):
        facility_id = self.kwargs.get("facility_id")
        facility_slug = self.kwargs.get("facility_slug")

        if facility_id:
            facility = get_object_or_404(Facility, id=facility_id)
        else:
            facility = get_object_or_404(Facility, slug=facility_slug)

        return Faculty.objects.filter(facultyprofile__facility_id=facility.id)

    def get_context_data(self, **kwargs):
        context = super().get_context_data(**kwargs)
        facility_id = self.kwargs.get("facility_id")
        facility_slug = self.kwargs.get("facility_slug")
        context["facility"] = (
            get_object_or_404(Facility, id=facility_id)
            if facility_id
            else get_object_or_404(Facility, slug=facility_slug)
        )
        return context


class ShowView(_DetailView):
    model = User
    template_name = "faculty/show.html"
    context_object_name = "faculty"

    def get_object(self):
        faculty_id = self.kwargs.get("faculty_id")
        faculty_slug = self.kwargs.get("faculty_slug")
        if faculty_id:
            return get_object_or_404(User, pk=faculty_id)
        else:
            return get_object_or_404(User, slug=faculty_slug)


class RegisterFacultyView(_FormView):
    template_name = "register_faculty.html"
    form_class = RegistrationForm
    success_url = reverse_lazy("home")

    def form_valid(self, form):
        form.save()
        username = form.cleaned_data.get("username")
        raw_password = form.cleaned_data.get("password1")
        user = authenticate(username=username, password=raw_password)
        if user is not None:
            login(self.request, user)
        return super().form_valid(form)
