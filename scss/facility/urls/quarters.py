# facility/urls/quarters.py

from django.urls import path

from ..views.quarters import (
    IndexView,
    IndexByFacilityView,
    IndexByQuartersTypeView,
    ShowView,
    CreateView,
    UpdateView,
    DeleteView,
    QuartersTypeIndexView,
    QuartersTypeIndexByOrganizationView,
    QuartersTypeShowView,
    QuartersTypeCreateView,
    QuartersTypeDeleteView,
    QuartersTypeUpdateView,
)

app_name = "quarters"

urlpatterns = [
    # Index
    path("", IndexView.as_view(), name="index"),
    path("types/", QuartersTypeIndexView.as_view(), name="quarters_type_index"),
    # Show
    path("<int:pk>", ShowView.as_view(), name="show"),
    path("<slug:slug>", ShowView.as_view(), name="show"),
    path("types/<int:pk>", QuartersTypeShowView.as_view(), name="quarters_type_show"),
    path(
        "types/<slug:slug>", QuartersTypeShowView.as_view(), name="quarters_type_show"
    ),
    # Create
    path("create/", CreateView.as_view(), name="create"),
    path(
        "types/create/", QuartersTypeCreateView.as_view(), name="quarters_type_create"
    ),
    # Update
    path("<int:pk>/update/", UpdateView.as_view(), name="update"),
    path(
        "types/<int:pk>/update/",
        QuartersTypeUpdateView.as_view(),
        name="quarters_type_update",
    ),
    # Delete
    path("<int:pk>/delete/", DeleteView.as_view(), name="delete"),
    path(
        "types/<int:pk>/delete/",
        QuartersTypeDeleteView.as_view(),
        name="quarters_type_delete",
    ),
    # Quarters views by facility
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
    # Quarters Types views by organization
    path(
        "organizations/<int:organization_pk>/quarters/types/",
        QuartersTypeIndexByOrganizationView.as_view(),
        name="quarters_type_index_by_organization",
    ),
    # Quarters views by quarters type
    path(
        "types/<int:pk>/quarters/",
        IndexByQuartersTypeView.as_view(),
        name="index_by_quarters_type",
    ),
    path(
        "types/<int:pk>/",
        IndexByQuartersTypeView.as_view(),
        name="index_by_quarters_type",
    ),
    path(
        "quarters/type/<slug:slug>/",
        IndexByQuartersTypeView.as_view(),
        name="index_by_quarters_type",
    ),
]
