# facility/urls/facility.py

from django.urls import path

from ..views.facility import (
    IndexView,
    IndexByOrganizationView,
    ShowView,
    CreateView,
    UpdateView,
    DeleteView,
    ManageView,
)

app_name = "facilities"

urlpatterns = [
    # Index
    path("", IndexView.as_view(), name="index"),
    # Show
    path("<int:pk>", ShowView.as_view(), name="show"),
    path("<slug:slug>", ShowView.as_view(), name="show"),
    # Manage
    path("<int:pk>", ManageView.as_view(), name="manage"),
    path("<slug:slug>", ManageView.as_view(), name="manage"),
    # Create
    path("create/", CreateView.as_view(), name="create"),
    # Update
    path("<int:pk>/update/", UpdateView.as_view(), name="update"),
    # Delete
    path("<int:pk>/delete/", DeleteView.as_view(), name="delete"),
    # Facility views by organization
    path(
        "organization/<int:organization_pk>/",
        IndexByOrganizationView.as_view(),
        name="index_by_organization",
    ),
    path(
        "organization/<slug:organization_slug>/",
        IndexByOrganizationView.as_view(),
        name="index_by_organization",
    ),
]
