""" Faction Related Dashboard Widgets. """
from django.shortcuts import render
from django.views import View

from pages.widgets import BaseWidget

from .models import Attendee, AttendeeProfile, Faction, LeaderProfile


class AttendeeListWidget(BaseWidget):
    """
    Widget for displaying a list of attendees.

    This widget retrieves the list of attendees associated with the current user's faction
    and adds it to the context data.

    Args:
        self: The instance of the class.
        request: The HTTP request object.

    Returns:
        dict: The context data for the attendee list widget.

    Raises:
        None

    Examples:
        None
    """

    template_name = "widgets/attendee_list.html"

    def get_context_data(self, request, **kwargs):
        """
        Get the context data for the attendee list widget.

        This method retrieves the list of attendees associated with the current user's faction
        and adds it to the context data.

        Args:
            request: The HTTP request object.
            **kwargs: Additional keyword arguments.

        Returns:
            dict: The context data for the attendee list widget.

        Raises:
            None

        Examples:
            None
        """
        current_user = request.user
        faction = None

        if hasattr(current_user, "leaderprofile"):
            faction = current_user.leaderprofile.faction
        elif hasattr(current_user, "attendeeprofile"):
            faction = current_user.attendeeprofile.faction
        
        if faction:
            attendees = Attendee.objects.filter(attendeeprofile__faction=faction)
        else:
            attendees = Attendee.objects.none()

        return {"attendees": attendees}

    def get(self, request, *args, **kwargs):
        """
        Handle the GET request for the attendee list widget.

        This method retrieves the context data for the attendee list widget and renders
        the widget's template with the context data.

        Args:
            request: The HTTP request object.
            *args: Additional positional arguments.
            **kwargs: Additional keyword arguments.

        Returns:
            HttpResponse: The rendered attendee list widget template.

        Raises:
            None

        Examples:
            None
        """
        context = self.get_context_data(request, **kwargs)
        return render(request, self.template_name, context)


class LeaderListWidget(BaseWidget):
    """
    Widget for displaying a list of leaders.

    This widget retrieves the list of leaders associated with the current user's faction
    and adds it to the context data.

    Args:
        self: The instance of the class.
        request: The HTTP request object.

    Returns:
        dict: The context data for the leader list widget.

    Raises:
        None

    Examples:
        None
    """

    template_name = "widgets/leader_list.html"

    def get_context_data(self, request, **kwargs):
        """
        Get the context data for the leader list widget.

        This method retrieves the list of leaders associated with the current user's faction
        and adds it to the context data.

        Args:
            request: The HTTP request object.
            **kwargs: Additional keyword arguments.

        Returns:
            dict: The context data for the leader list widget.

        Raises:
            None

        Examples:
            None
        """
        current_user = request.user
        faction = None

        if hasattr(current_user, "leaderprofile"):
            faction = current_user.leaderprofile.faction
        elif hasattr(current_user, "leaderprofile"):
            faction = current_user.leaderprofile.faction

        if faction:
            leaders = Leader.objects.filter(leaderprofile__faction=faction)
        else:
            leaders = Leader.objects.none()

        return {"leaders": leaders}

    def get(self, request, *args, **kwargs):
        """
        Handle the GET request for the leader list widget.

        This method retrieves the context data for the leader list widget and renders
        the widget's template with the context data.

        Args:
            request: The HTTP request object.
            *args: Additional positional arguments.
            **kwargs: Additional keyword arguments.

        Returns:
            HttpResponse: The rendered leader list widget template.

        Raises:
            None

        Examples:
            None
        """
        context = self.get_context_data(request, **kwargs)
        return render(request, self.template_name, context)
