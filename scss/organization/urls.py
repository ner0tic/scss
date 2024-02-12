""" Organization URLs. """

from django.urls import path

from . import views

urlpatterns = [
    #############################
    # Organization Related URLs #
    #############################
    path("organizations/", views.organization_index, name="organization_index"),
    path(
        "organizations/root",
        views.organization_index_root,
        name="organization_index_root",
    ),
    path(
        "organizations/<int:organization_id>/", views.organization_show, name="organization_show"
    ),
    path(
        "organizations/<slug:organization_slug>/",
        views.organization_show,
        name="organization_show",
    ),
    path(
        "organizations/<int:organization_id>/children",
        views.organization_index_by_parent,
        name="organization_index_by_parent",
    ),
    path(
        "organizations/<slug:organization_slug>/children",
        views.organization_index_by_parent,
        name="organization_index_by_parent",
    ),
]
