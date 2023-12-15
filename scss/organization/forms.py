from flask_wtf import FlaskForm
from wtforms import StringField, SubmitField, SelectField, TextAreaField, HiddenField
from wtforms.validators import InputRequired, Length


class EditOrganizationForm(FlaskForm):
    """
    Class representing an Edit Organization Form.

    This class represents a form for editing the details of an Organization. It includes fields for the organization's name, short name, description, avatar URL, and parent. The form can be submitted to update the organization's information.

    Attributes:
        name (StringField): The field for the organization's name.
        short_name (StringField): The field for the organization's short name.
        description (TextAreaField): The field for the organization's description.
        avatar_url (StringField): The field for the organization's avatar URL.
        parent (SelectField): The field for selecting the organization's parent.
        submit (SubmitField): The field for submitting the form.
    """

    name = StringField("Name", validators=[InputRequired()])
    short_name = StringField("Short Name")
    description = TextAreaField("Description", validators=[InputRequired()])
    avatar_url = StringField("Avatar URL")
    parent = SelectField(
        "Parent", coerce=int, validators=[InputRequired("Parent required!")]
    )

    submit = SubmitField("Submit")


class OrganizationAddForm(FlaskForm):
    """
    The `OrganizationAddForm` class represents a form for adding an organization.

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

    name = StringField(
        "Organization Name",
        validators=[
            InputRequired("Organization Name required!"),
            Length(
                min=5, max=25, message="Organization Name must be in 5 to 25 characters"
            ),
        ],
    )
    short_name = StringField(
        "Organization Short Name",
        validators=[
            Length(
                min=2,
                max=25,
                message="Organization Short Name must be in 3 to 25 characters",
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
    factions = HiddenField(
        "Organization Factions", default=0
    )  # , validators=[InputRequired('Organization Factions required!')])
    submit = SubmitField("Submit")
