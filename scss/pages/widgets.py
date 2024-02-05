""" Dashboard Widget Related Views. """
from django.views import View
from django.shortcuts import render

class BaseWidget(View):
    """
    Base class for widgets.

    This class provides common functionality for all widgets.

    Args:
        self: The instance of the class.

    Returns:
        None

    Raises:
        None

    Examples:
        None
    """

    template_name = ''
    context = {}

    def get_context_data(self, **kwargs):
        """
        Get the context data for the widget.

        This method retrieves the context data for the widget and updates it with the
        additional context provided by the widget.

        Args:
            **kwargs: Additional keyword arguments.

        Returns:
            dict: The context data for the widget.

        Raises:
            None

        Examples:
            None
        """
        context = super().get_context_data(**kwargs)
        context.update(self.context)
        return context

    def get(self, request, *args, **kwargs):
        """
        Handle the GET request for the widget.

        This method retrieves the context data for the widget and renders the widget's
        template with the context data.

        Args:
            request: The HTTP request object.
            *args: Additional positional arguments.
            **kwargs: Additional keyword arguments.

        Returns:
            HttpResponse: The rendered widget template.

        Raises:
            None

        Examples:
            None
        """
        context = self.get_context_data(**kwargs)
        return render(request, self.template_name, context)

