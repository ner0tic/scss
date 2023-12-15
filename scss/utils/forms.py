from flask_wtf import FlaskForm
from wtforms import StringField, BooleanField, SubmitField, HiddenField
from wtforms.validators import InputRequired
from wtform_address import CountrySelectField, StateSelectField


class AddressForm(FlaskForm):
    """
    Module: forms

    This module defines form fields for address information.

    Classes:
        StringField:
            A form field for a string input.
            Args:
                label: The label for the field.
                validators: Optional list of validators for the field.
            Returns:
                An instance of the StringField class.

        StateSelectField:
            A form field for selecting a state.
            Args:
                default: The default value for the field.
            Returns:
                An instance of the StateSelectField class.

        CountrySelectField:
            A form field for selecting a country.
            Args:
                default: The default value for the field.
            Returns:
                An instance of the CountrySelectField class."""

    # name = StringField('Name')
    line1 = StringField("Address", validators=[InputRequired("Line 1 required!")])
    line2 = StringField("Address Line 2")
    city = StringField("City", validators=[InputRequired("City required!")])
    state = StateSelectField(
        default="US-ME"
    )
    postal_code = StringField(
        "Postal Code", validators=[InputRequired("Postal Code required!")]
    )
    country = CountrySelectField(
        default="US"
    )
    submit = SubmitField("Submit")

class AddressAddForm(AddressForm):
    """
    Class representing an Address Add Form.

    This class extends the AddressForm class and represents a form for adding a new address. It initializes the form by calling the parent class's constructor and updates the label of the submit button to 'Add Address'.

    Attributes:
        None
    """

    def __init__(self, *args, **kwargs):
        super(AddressAddForm, self).__init__(*args, **kwargs)
        self.submit.label.text = "Add Address"


class EditAddressForm(AddressForm):
    """
    Class representing an Edit Address Form.

    This class extends the AddressForm class and represents a form for editing an existing address. It initializes the form by calling the parent class's constructor and updates the label of the submit button to 'Update Address'.

    Attributes:
        None
    """

    def __init__(self, *args, **kwargs):
        super(EditAddressForm, self).__init__(*args, **kwargs)
        self.submit.label.text = "Update Address"


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
    submit = SubmitField("Delete")
