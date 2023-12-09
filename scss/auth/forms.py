from flask_wtf import FlaskForm as Form
from wtforms import StringField, PasswordField
from wtforms.validators import DataRequired
from flask_babel import gettext
from scss.user.models import User


class LoginForm(Form):
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