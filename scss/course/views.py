""" Course Related Views. """

from django.core.exceptions import ValidationError
from django.db.models import Q
from django.shortcuts import get_object_or_404, redirect, render

from .models import Course, Requirement


def course_index(request):
    """Course list view."""

    if query := request.GET.get('q'):
        courses = Course.objects.filter(Q(name__icontains=query) | Q(description__icontains=query))
    else:
        courses = Course.objects.all()

    return render(request, "course/list.html", {"courses": courses})


def course_show(request, course_id=None, course_slug=None):
    """Course details view."""
    if course_id:
        course = get_object_or_404(Course, pk=course_id)
    else:
        course = get_object_or_404(Course, slug=course_slug)

    return render(request, "course/show.html", {"course": course})


def requirement_index(request):
    """Requirement list view."""
    requirements = Requirement.objects.all()

    return render(request, "requirement/list.html", {"requirements": requirements})


def requirement_index_by_course(request, course_id=None, course_slug=None):
    """Requirement list by course view."""
    if course_id:
        course = get_object_or_404(Course, pk=course_id)
    else:
        course = get_object_or_404(Course, slug=course_slug)

    requirements = Requirement.objects.filter(course=course)

    return render(
        request,
        "requirement/list.html",
        {"course": course, "requirements": requirements},
    )


def requirement_show(request, requirement_id=None, requirement_slug=None):
    """Requirement details view."""
    if requirement_id:
        requirement = get_object_or_404(Requirement, pk=requirement_id)
    else:
        requirement = get_object_or_404(Requirement, slug=requirement_slug)

    return render(request, "requirement/show.html", {"requirement": requirement})
