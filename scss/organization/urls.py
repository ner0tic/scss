""" Organization URLs. """
from django.urls import path
from . import views

urlpatterns = [
    path('', views.root_index, name='index_organizations_parentless'),
    # Paths by id
    path('<int:org_id>/', views.show, name='show_organization'),
    path('<int:org_id>/children', views.index_by_parent, name='index_organization_by_parent'),
    # Paths by slug
    path('<str:org_slug>/', views.show, name='show_organization'),
    path('<str:org_slug>/children', views.index_by_parent, name='index_organization_by_parent')
]
