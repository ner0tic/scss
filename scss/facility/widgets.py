""" Facility Related Dashboard Widgets. """
from django.views import View
from django.shortcuts import render
from pages.widgets import BaseWidget
from .models import Faculty, Facility


class FacultyListWidget(BaseWidget):
    """
    Widget for displaying a list of faculty.

    This widget retrieves the list of faculty associated with the current user's facility
    and adds it to the context data.

    Args:
        self: The instance of the class.
        request: The HTTP request object.

    Returns:
        dict: The context data for the faculty list widget.

    Raises:
        None

    Examples:
        None
    """

    template_name = "widgets/faculty_list.html"

    def get_context_data(self, request, **kwargs):
        """
        Get the context data for the faculty list widget.

        This method retrieves the list of faculty associated with the current user's facility
        and adds it to the context data.

        Args:
            request: The HTTP request object.
            **kwargs: Additional keyword arguments.

        Returns:
            dict: The context data for the faculty list widget.

        Raises:
            None

        Examples:
            None
        """
        current_user = request.user
        facility = None

        if hasattr(current_user, "facultyprofile"):
            facility = current_user.facultyprofile.facility

        if facility:
            faculty = Faculty.objects.filter(facultyprofile__facility=facility)
        else:
            faculty = Faculty.objects.none()

        return {"faculty": faculty}

    def get(self, request, *args, **kwargs):
        """
        Handle the GET request for the faculty list widget.

        This method retrieves the context data for the faculty list widget and renders
        the widget's template with the context data.

        Args:
            request: The HTTP request object.
            *args: Additional positional arguments.
            **kwargs: Additional keyword arguments.

        Returns:
            HttpResponse: The rendered faculty list widget template.

        Raises:
            None

        Examples:
            None
        """
        context = self.get_context_data(request, **kwargs)
        return render(request, self.template_name, context)
