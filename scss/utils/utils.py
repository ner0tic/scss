""" Utility functions for the application. """
from flask import request, url_for

INTERNAL_SERVER_ERROR = 500
NOT_FOUND = 404
UNAUTHORIZED = 401

def url_for_other_page(**kwargs):
    """Returns a URL aimed at the current request endpoint and query args."""
    url_for_args = request.args.copy()
    if 'pjax' in url_for_args:
        url_for_args.pop('_pjax')
    for key, value in kwargs.items():
        url_for_args[key] = value
    return url_for(request.endpoint, **url_for_args)

def set_form_choices(form, choices_mapping):
    """Sets the choices for select form fields in a given form.
    Args:
        form: The form to set the choices for.
        choices_mapping: A dictionary mapping field names to choices.
            Each key-value pair represents a form field name and its corresponding choices.
            The value can be a list of tuples or a query object.
    Returns:
        None.
    """
    for field_name, choices in choices_mapping.items():
        if field_name in form._fields:
            if isinstance(choices, list):
                form._fields[field_name].choices = choices
            else:
                form._fields[field_name].choices = generate_choices_from_query(choices)

def generate_choices_from_list(list, label_attr='name', value_attr='id'):
    """Generates choices from a list.
    Args:
        list: The list to generate choices from.
        label_attr: The attribute of the list item to use as the choice label. Default is 'name'.
        value_attr: The attribute of the list item to use as the choice value. Default is 'id'.
    Returns:
        A list of tuples representing the choices.
    """
    return [(0, 'None')]+[(getattr(item, value_attr), getattr(item, label_attr)) for item in list]

def generate_choices_from_query(query, label_attr='name', value_attr='id'):
    """Generates choices from a query object.
    Args:
        query: The query object to generate choices from.
        label_attr: The attribute of the query object to use as the choice label. Default is 'name'.
        value_attr: The attribute of the query object to use as the choice value. Default is 'id'.
    Returns:
        A list of tuples representing the choices.
    """
    return [(0, 'None')]+[(getattr(item, value_attr), getattr(item, label_attr)) for item in query]

def gettext(string):
    """Returns a translated string."""
    return string
