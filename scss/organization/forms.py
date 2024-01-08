""" Organization Forms """
from flask_wtf import FlaskForm
from wtforms import StringField, SubmitField, SelectField, TextAreaField
from wtforms.validators import InputRequired, Length

class OrganizationForm(FlaskForm):
    """
    The `OrganizationForm` class represents a form for adding an organization.

    Args:
        organization_name (str): The name of the organization.
        organization_short_name (str): The short name of the organization.
        organization_description (str): The description of the organization.
        organization_avatar_url (str): The URL of the organization's avatar.
        organization_parent (int): The ID of the parent organization.
        organization_factions (int): The number of factions associated with the organization.

    Attributes:
        submit: A submit button.

    Returns:
        None
    """
    inc_submit_field = False # @Todo: globalize this to check against

    name = StringField(
        "Organization Name",
        validators=[
            InputRequired("Organization Name required!"),
            Length(
                min=5, max=25, message="Organization Name must be in 5 to 25 characters"
            ),
        ],
    )

    abbreviation = StringField(
        "Organization Abbreviation",
        validators=[
            Length(
                min=2,
                max=25,
                message="Organization Abbreviation must be in 3 to 25 characters",
            )
        ],
    )

    description = TextAreaField(
        "Organization Description",
        validators=[
            Length(
                min=5,
                max=25,
                message="Organization Description must be in 5 to 25 characters",
            )
        ],
    )

    avatar_url = StringField("Organization Avatar URL")

    parent = SelectField(
        "Organization Parent",
        coerce=int,
        validators=[InputRequired("Organization Parent required!")],
    )

    if inc_submit_field:
        submit = SubmitField("Submit")
