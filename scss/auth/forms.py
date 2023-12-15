from flask_wtf import FlaskForm as Form
from wtforms import StringField, PasswordField
from wtforms.validators import DataRequired
from flask_babel import gettext
from ..user.models import User


class LoginForm(Form):
    """
    Class representing a Login Form.

    This class represents a form for user login. It inherits from the Form class. The LoginForm class has fields for the username and password, with corresponding validators. It provides an initializer method and a validate method to perform form validation, including checking the username and password against the User model in the database.

    Attributes:
        username (StringField): The field for the username.
        password (PasswordField): The field for the password.
        user (User): The user object associated with the login form.

    Methods:
        __init__(*args, **kwargs): Initializes the login form.
        validate(extra_validators=None): Performs form validation, including checking the username and password against the User model.

    Returns:
        bool: True if the form is valid, False otherwise.
    """

    username = StringField(gettext('Username'), validators=[DataRequired()])
    password = PasswordField(gettext('Password'), validators=[DataRequired()])

    def __init__(self, *args, **kwargs):
        Form.__init__(self, *args, **kwargs)
        self.user = None

    def validate(self, extra_validators=None):
        rv = Form.validate(self)
        if not rv:
            return False

        self.user = User.query.filter_by(username=self.username.data).first()

        if not self.user:
            self.username.errors.append(gettext('Unknown username'))
            return False

        if not self.user.check_password(self.password.data):
            self.password.errors.append(gettext('Invalid password'))
            return False

        if not self.user.active:
            self.username.errors.append(gettext('User not activated'))
            return False

        return True