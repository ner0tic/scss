# facility/urls.py

from django.urls import path, include

app_name = 'facility'

urlpatterns = [
    path('facilities/', include('facility.urls.facility', namespace='facilities')),
    path('departments/', include('facility.urls.department', namespace='departments')),
    path('quarters/', include('facility.urls.quarters', namespace='quarters')),
]