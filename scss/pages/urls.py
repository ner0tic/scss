from django.urls import path
from . import views

urlpatterns = [
    path("", views.index, name="index"),
path("", views.index, name="home"),
    path("about", views.about, name="about"),
    path("help", views.help, name="help"),
    path(
        "dynamic-dropdown-options/<app_label>/<model_name>/<field_name>/<filter_value>/",
        views.dynamic_dropdown_options,
        name="dynamic-dropdown-options",
    ),
]
