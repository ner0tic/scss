# facility/views/department.py

from django.views.generic import ListView as _ListView, DetailView as _DetailView
from django.shortcuts import get_object_or_404

from ..models.department import Department
from ..models.facility import Facility


class IndexView(_ListView):
    model = Department
    template_name = "department/index.html"
    context_object_name = "departments"


class IndexByFacilityView(_ListView):
    model = Department
    template_name = "department/index.html"
    context_object_name = "departments"

    def get_queryset(self):
        facility_id = self.kwargs.get("facility_id")
        facility_slug = self.kwargs.get("facility_slug")

        if facility_id:
            facility = get_object_or_404(Facility, id=facility_id)
        else:
            facility = get_object_or_404(Facility, slug=facility_slug)

        return Department.objects.filter(facility_id=facility.id)

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
    model = Department
    template_name = "department/show.html"
    context_object_name = "department"

    def get_object(self):
        department_id = self.kwargs.get("department_id")
        department_slug = self.kwargs.get("department_slug")
        if department_id:
            return get_object_or_404(Department, pk=department_id)
        else:
            return get_object_or_404(Department, slug=department_slug)
