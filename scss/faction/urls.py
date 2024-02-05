""" Faction Related URLs. """
from django.urls import path
from .widgets import AttendeeListWidget, LeaderListWidget

urlpatterns = [
    ###################################
    # Dashboard Widget Related Routes #
    ###################################
    path('attendee-list-widget/', AttendeeListWidget.as_view(), name='attendee_list_widget'),
    path('leader-list-widget/', LeaderListWidget.as_view(), name='leader_list_widget'),
]
