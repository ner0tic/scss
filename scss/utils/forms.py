""" Utility Forms. """
from flask_wtf import FlaskForm
from wtforms import BooleanField, HiddenField # , SubmitField

class DeleteConfirmationForm(FlaskForm):
    """
    Class representing a Delete Confirmation Form.

    This class represents a form for confirming the deletion of an element.
    It includes a checkbox for confirming the deletion, a hidden field for storing the element ID,
    and a submit button for initiating the deletion.

    Attributes:
        confirm (BooleanField): The checkbox for confirming the deletion.
        id (HiddenField): The hidden field for storing the element ID.
        submit (SubmitField): The button for deleting the element.
    """

    confirm = BooleanField("Confirm deletion?")
    id = HiddenField("Element ID")
#    submit = SubmitField("Delete")

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
