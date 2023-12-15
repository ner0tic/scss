""" Facility Forms """
from flask_wtf import FlaskForm
from wtforms import (
    StringField,
    SubmitField,
    SelectField,
    TextAreaField,
    FormField,
    HiddenField,
)
from wtforms.validators import InputRequired
from ..utils.forms import AddressAddForm


class EditFacilityForm(FlaskForm):
    """
    Class representing a Facility Add Form.

    This class represents a form for adding a new facility. It includes fields for the facility's name, description, avatar, address, organization, and factions. The form can be submitted to add the facility to the database.

    Attributes:
        name (StringField): The field for the facility's name.
        description (StringField): The field for the facility's description.
        avatar (StringField): The field for the facility's avatar.
        address_id (FormField): The field for the facility's address, using the AddressAddForm.
        organization_id (SelectField): The field for selecting the facility's organization.
        factions (HiddenField): The hidden field for storing the facility's factions.
        submit (SubmitField): The field for submitting the form.
    """

    name = StringField("Name", validators=[InputRequired("Name required!")])
    description = TextAreaField("Description")
    avatar = StringField("Avatar")
    address_id = FormField(AddressAddForm, label="Address")  # StringField('Address ID')
    organization_id = SelectField(
        "Organization", coerce=int, validators=[InputRequired("Organization required!")]
    )
    factions = HiddenField("Factions", default=0)
    submit = SubmitField("Submit")


class FacilityAddForm(FlaskForm):
    """
    Class representing a Facility Add Form.

    This class represents a form for adding a new facility. It includes fields for the facility's name, description, avatar, address, organization, and factions. The form can be submitted to add the facility to the database.

    Attributes:
        name (StringField): The field for the facility's name.
        description (StringField): The field for the facility's description.
        avatar (StringField): The field for the facility's avatar.
        address_id (FormField): The field for the facility's address, using the AddressAddForm.
        organization_id (SelectField): The field for selecting the facility's organization.
        factions (HiddenField): The hidden field for storing the facility's factions.
        submit (SubmitField): The field for submitting the form.
    """

    name = StringField("Name", validators=[InputRequired("Name required!")])
    description = StringField("Description")
    avatar = StringField("Avatar")
    address_id = FormField(AddressAddForm, label="Address")  # StringField('Address ID')
    organization_id = SelectField(
        "Organization", coerce=int, validators=[InputRequired("Organization required!")]
    )
    factions = HiddenField(
        "Factions", default=0
    )  # , validators=[InputRequired('Organization Factions required!')])
    submit = SubmitField("Submit")
