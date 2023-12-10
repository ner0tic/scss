from flask_wtf import FlaskForm
from wtforms import StringField, SubmitField, SelectField, TextAreaField
from wtforms.validators import InputRequired

from .models import Organization

class EditOrganizationForm(FlaskForm):
    name = StringField('Name', validators=[InputRequired()])
    short_name = StringField('Short Name')
    description = TextAreaField('Description', validators=[InputRequired()])
    avatar_url = StringField('Avatar URL')
    parent = SelectField('Parent', coerce=int, validators=[InputRequired('Parent required!')])

    submit = SubmitField('Submit')
