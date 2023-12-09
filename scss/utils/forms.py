from flask_wtf import FlaskForm 
from wtforms import StringField
from wtforms.validators import InputRequired
from wtform_address import CountrySelectField, StateSelectField

class AddressAddForm(FlaskForm):
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
            An instance of the CountrySelectField class.
"""

    # name = StringField('Name')
    line1 = StringField('Address', validators=[InputRequired('Line 1 required!')])
    line2 = StringField('Address Line 2')
    city = StringField('City', validators=[InputRequired('City required!')])
    state = StateSelectField(default="US-ME") # StringField('State', validators=[InputRequired('State required!')])
    postal_code = StringField('Postal Code', validators=[InputRequired('Postal Code required!')])
    country = CountrySelectField(default="US") # StringField('Country', validators=[InputRequired('Country required!')])
    # submit = SubmitField('Submit')