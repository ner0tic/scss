# facility/urls/department.py

from django.urls import path

from ..views.department import (
    IndexView,
    IndexByFacilityView,
    ShowView,
    CreateView,
    UpdateView,
    DeleteView,
    ManageView,
)

app_name = "department"

urlpatterns = [
    # Index
    path("", IndexView.as_view(), name="index"),
    # Show
    path("<int:pk>", ShowView.as_view(), name="show"),
    path("<slug:slug>", ShowView.as_view(), name="show"),
    # Create
    path("create/", CreateView.as_view(), name="create"),
    # Update
    path("<int:pk>/update/", UpdateView.as_view(), name="update"),
    # Delete
    path("<int:pk>/delete/", DeleteView.as_view(), name="delete"),
    # Department views by facility
    path(
        "facilities/<int:facility_pk>/",
        IndexByFacilityView.as_view(),
        name="index_by_facility",
    ),
    path(
        "facilities/<slug:facility_slug>/",
        IndexByFacilityView.as_view(),
        name="index_by_facility",
    ),
]
