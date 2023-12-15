""" Faction forms """
from flask_wtf import FlaskForm
from wtforms import (
    StringField,
    SubmitField,
    SelectField,
    FormField
)
from wtforms.validators import InputRequired
from ..utils.forms import AddressAddForm

class FactionEnrollmentAddForm(FlaskForm):
    faction_id = StringField("Faction ID")
    temporal_hierarchy_id = StringField("Temporal Hierarchy ID")
    quarters_id = StringField("Quarters ID")
    
class FactionAddForm(FlaskForm):
    name = StringField("Name", validators=[InputRequired("Name required!")])
    short_name = StringField("Short Name")
    description = StringField("Description")
    avatar_url = StringField("Avatar")
    address_id = FormField(AddressAddForm, label="Address")
    organization_id = SelectField(
        "Organization",
        coerce=int,
        validators=[InputRequired("Organization required!")]
    )
    parent_id = SelectField(
        "Parent",
        coerce=int,
        validators=[InputRequired("Parent required!")]
    )
    submit = SubmitField("Submit")

class EditFactionForm(FlaskForm):
    name = StringField("Name", validators=[InputRequired("Name required!")])
    short_name = StringField("Short Name")
    description = StringField("Description")
    avatar_url = StringField("Avatar")
    address_id = FormField(AddressAddForm, label="Address")
    organization_id = SelectField(
        "Organization",
        coerce=int,
        validators=[InputRequired("Organization required!")]
    )
    parent_id = SelectField(
        "Parent",
        coerce=int,
        validators=[InputRequired("Parent required!")]
    )
    submit = SubmitField("Submit")
