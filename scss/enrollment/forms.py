from flask_wtf import FlaskForm
from wtforms import StringField, SubmitField, SelectField, TextAreaField
from wtforms.validators import InputRequired

class EditTemporalHierarchyForm(FlaskForm):
    """
    Class representing an Edit Temporal Hierarchy Form.

    This class represents a form for editing the details of a Temporal Hierarchy. It includes fields for the hierarchy's name, short name, description, avatar URL, parent, and organization. The form can be submitted to update the hierarchy's information.

    Attributes:
        name (StringField): The field for the hierarchy's name.
        short_name (StringField): The field for the hierarchy's short name.
        description (TextAreaField): The field for the hierarchy's description.
        avatar_url (StringField): The field for the hierarchy's avatar URL.
        parent (SelectField): The field for selecting the hierarchy's parent.
        organization_id (SelectField): The field for selecting the hierarchy's organization.
        submit (SubmitField): The field for submitting the form.
    """

    name = StringField("Name", validators=[InputRequired()])
    short_name = StringField("Short Name")
    description = TextAreaField("Description", validators=[InputRequired()])
    avatar_url = StringField("Avatar URL")
    parent = SelectField(
        "Parent", coerce=int, validators=[InputRequired("Parent required!")]
    )
    organization_id = SelectField(
        "Organization", coerce=int, validators=[InputRequired("Organization required!")]
    )

    submit = SubmitField("Submit")
