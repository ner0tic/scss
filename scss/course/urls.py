""" Course URLs. """

from django.urls import path

from . import views

urlpatterns = [
    #######################
    # Course Related URLs #
    #######################
    path("courses/", views.course_index, name="course_index"),
    path("courses/<int:course_id>/", views.course_show, name="course_show"),
    path("courses/<slug:course_slug>", views.course_show, name="course_show"),
    ############################
    # Requirement Related URLs #
    ############################
    path("requirements/", views.requirement_index, name="requirement_index"),
    path(
        "requirements/<int:requirement_id>",
        views.requirement_show,
        name="requirement_show",
    ),
    path(
        "requirements/<slug:requirement_slug>",
        views.requirement_show,
        name="requirement_show",
    ),
    path(
        "courses/<int:course_id>/requirements",
        views.requirement_index_by_course,
        name="requirement_index_by_course",
    ),
    path(
        "courses/<slug:course_slug>/requirements",
        views.requirement_index_by_course,
        name="requirement_index_by_course",
    ),
]
