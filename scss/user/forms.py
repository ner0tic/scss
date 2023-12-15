from flask import Flask
from flask_wtf import FlaskForm as Form
from wtforms import StringField, PasswordField, SelectField, HiddenField, BooleanField, FormField
from wtforms.validators import InputRequired, Length, DataRequired, Email, EqualTo
from flask_babel import gettext
from ..utils.forms import AddressAddForm
from .models import User

class UserForm(Form):
    username = StringField(
        gettext('Username'), validators=[DataRequired(), Length(min=2, max=20)]
    )
    email = StringField(
        gettext('Email'), validators=[Email(), DataRequired(), Length(max=128)]
    )

    def __init__(self, *args, **kwargs):
        Form.__init__(self, *args, **kwargs)


class RegisterUserForm(UserForm):
    username = StringField('Username', validators=[InputRequired('Username required!'),
                Length(min=5, max=25, message='Username must be in 5 to 25 characters')])
    email = StringField('Email', validators=[InputRequired('Email required!'),
                Length(min=5, max=25, message='Email must be in 5 to 25 characters')])
    first_name = StringField('First Name', validators=[InputRequired('First Name required!'),
                Length(min=5, max=25, message='First Name must be in 5 to 25 characters')])
    last_name = StringField('Last Name', validators=[InputRequired('Last Name required!'),
                Length(min=5, max=25, message='Last Name must be in 5 to 25 characters')])
    address_id = FormField(AddressAddForm, label="Address") # StringField('Address ID')
    avatar_url = StringField('Avatar URL')
    role = HiddenField('Role', default='user')
    password = PasswordField(gettext('Password'),
        validators=[
            DataRequired(),
            EqualTo('confirm', message=gettext('Passwords must match')),
            Length(min=6, max=20)
        ]
    )
    confirm = PasswordField(
        gettext('Confirm Password'), validators=[DataRequired()]
    )
    accept_tos = BooleanField(
        gettext('I accept the TOS'), validators=[DataRequired()]
    )

    def __init__(self, *args, **kwargs):
        Form.__init__(self, *args, **kwargs)
        self.user = None

    def validate(self, extra_validators=None):
        rv = Form.validate(self)
        if not rv:
            return False

        user = User.query.filter_by(username=self.username.data).first()
        if user:
            self.username.errors.append(gettext('Username already registered'))
            return False

        user = User.query.filter_by(email=self.email.data).first()
        if user:
            self.email.errors.append(gettext('Email already registered'))
            return False

        self.user = user
        return True


class EditUserForm(UserForm):
    is_admin = BooleanField(gettext('Admin'))
    active = BooleanField(gettext('Activated'))
