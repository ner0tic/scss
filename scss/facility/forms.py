from flask_wtf import FlaskForm
from wtforms import StringField, SubmitField, SelectField, TextAreaField, FormField, HiddenField
from wtforms.validators import InputRequired

from scss.utils.forms import AddressAddForm

from .models import Facility

class EditFacilityForm(FlaskForm):
    name = StringField('Name', validators=[InputRequired('Name required!')])
    description = TextAreaField('Description')
    avatar = StringField('Avatar')
    address_id = FormField(AddressAddForm, label='Address') # StringField('Address ID')
    organization_id = SelectField('Organization', coerce=int, validators=[InputRequired('Organization required!')])
    factions = HiddenField('Factions', default=0) # , validators=[InputRequired('Organization Factions required!')])
    submit = SubmitField('Submit')