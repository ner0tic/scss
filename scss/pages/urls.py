from django.contrib import admin
from django.urls import path, include
from django.conf import settings
from django.conf.urls.static import static
from django.views.generic import TemplateView

from . import views

urlpatterns = [
    # Messaging & Notification
    path("inbox/", views.inbox, name="inbox"),
    path("sent/", views.sent_messages, name="sent_messages"),
    path("send/", views.send_message, name="send_message"),
    path("notifications/", views.notifications, name="notifications"),
    path(
        "messages/read/<int:message_id>/",
        views.mark_message_as_read,
        name="mark_message_as_read",
    ),
    path(
        "notifications/read/<int:notification_id>/",
        views.mark_notification_as_read,
        name="mark_notification_as_read",
    ),
    # Landing Page
    path("", views.index, name="index"),
    path("", views.index, name="home"),
    # Static Pages
    path(
        "privacy-policy",
        TemplateView.as_view(template_name="base/privacy_policy.html"),
        name="privacy_policy",
    ),
    path(
        "donate", TemplateView.as_view(template_name="base/donate.html"), name="donate"
    ),
    path("about", TemplateView.as_view(template_name="base/about.html"), name="about"),
    # Help Page
    path("help", views.help, name="help"),
    # Dynamic pages
    path(
        "dynamic-dropdown-options/<app_label>/<model_name>/<field_name>/<filter_value>/",
        views.dynamic_dropdown_options,
        name="dynamic-dropdown-options",
    ),
    path("save-layout/", views.save_layout, name="save_layout"),
]
