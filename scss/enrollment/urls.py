# enrollments/{faction_enrollment.slug}/ #show
# enrollments/{faction_enrollment.slug/attendees}
""" Enrollment Related URLs. """
from django.urls import path
import .views

urlpatterns = [
    # Organization Enrollment Related URLs
    path('organization-enrollments/', views.organization_enrollment_index, name="organization_enrollment_index"),
    path('organization-enrollments/year/<int:year>/', views.organization_enrollment_index_by_year, name='organization_enrollment_index_by_year'),
    path('organizations/<int:organization_id>/enrollments', views.organization_enrollment_index_by_organization, name="organization_enrollment_index_by_organization"),
    path('organizations/<str:organization_slug>/enrollments', views.organization_enrollment_index_by_organization, name='organization_enrollment_index_by_organization'),

    # Week Related URLs

    # Period Related URLs

    # Facility Enrollment Related URLs

    # Faction Enrollment Related URLs

    # Leader Enrollment Related URLs

    # Attendee Enrollment Related URLs

    # Attendee Class Enrollment Related URLs

    # Organization Course Related URLs

    # Facility Class Related URLs

    # Facility Class Enrollment Related URLs

    # Faculty Class Enrollment Related URLs

    # Active Enrollment Related URLs

]
