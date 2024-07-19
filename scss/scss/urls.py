# scss/urls.py

from django.conf import settings
from django.conf.urls.static import static
from django.contrib import admin
from django.urls import include, path
from django.views.generic import TemplateView

urlpatterns = [
    path('', include('pages.urls')),
    path("admin/", admin.site.urls),
    path('', include('user.urls')),
    path('', include('organization.urls')),
    path('', include('enrollment.urls')),
    path('', include('facility.urls')),
    path('', include('faction.urls')),
    path('', include('course.urls')),
    path("__debug__/", include("debug_toolbar.urls")),
    path("__reload__/", include("django_browser_reload.urls")),
] + static(settings.STATIC_URL, document_root=settings.STATIC_ROOT)
