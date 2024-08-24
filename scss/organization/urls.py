""" Organization URLs. """

from rest_framework.routers import DefaultRouter
from django.urls import path, include

from .views.organization import (
    ListView,
    RootListView,
    CreateView,
    DetailView,
    ListByParentView,
    SubOrganizationCreateView,
    OrganizationViewSet,
)

router = DefaultRouter()
router.register(r"organizations", OrganizationViewSet)

urlpatterns = [
    #############################
    # Organization Related URLs #
    #############################

    # Index
    path("organizations/", ListView.as_view(), name="organization_index"),
    path(
        "organizations/root/",
        RootListView.as_view(),
        name="organization_index_root",
    ),
    path(
        "organizations/<int:organization_id>/children/",
        ListByParentView.as_view(),
        name="organization_index_by_parent_id",
    ),
    path(
        "organizations/<slug:organization_slug>/children/",
        ListByParentView.as_view(),
        name="organization_index_by_parent_slug",
    ),

    # New
    path(
        "organizations/new/", CreateView.as_view(), name="organization_new"
    ),
    path(
        "organiations/<slug:organization_slug>/children/new/",
        SubOrganizationCreateView.as_view(),
        name="sub_organization_create",
    ),

    # Show
    path(
        "organizations/<int:organization_id>/",
        DetailView.as_view(),
        name="organization_show_by_id",
    ),
    path(
        "organizations/<slug:organization_slug>/",
        DetailView.as_view(),
        name="organization_show_by_slug",
    ),

    # API
    path(r"", include(router.urls)),
]
