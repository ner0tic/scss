# facility/urls/faculty.py

from django.urls import path

from ..views.faculty import (
    IndexView,
    IndexByOrganizationView,
    IndexByFacilityView,
    ShowView,
    CreateView,
    UpdateView,
    DeleteView,
    ManageView,
)

app_name = "faculty"

urlpatterns = [

# Faculty views
    path('', IndexView.as_view(), name='faculty_index'),
    path('<slug:slug>/', ShowView.as_view(), name='faculty_show'),
    path('create/', CreateView.as_view(), name='faculty_create'),
    path('<slug:slug>/edit/', UpdateView.as_view(), name='faculty_edit'),
    path('<slug:slug>/delete/', DeleteView.as_view(), name='faculty_delete'),
    # Manage faculty list (shows all faculty if no slug/pk is given)
    path('manage/', ManageView.as_view(), name='faculty_manage'),
    
    # Manage specific faculty (actions based on slug or pk)
    path('manage/<slug:slug>/', ManageView.as_view(), name='faculty_manage'),
    path('manage/<int:pk>/', ManageView.as_view(), name='faculty_manage'),
]
