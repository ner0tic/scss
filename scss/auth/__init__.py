""" Auth related blueprints. """
from flask import Blueprint
from flask_admin import Admin

auth = Blueprint('auth', __name__, template_folder='templates')
admin_bp = Blueprint('admin_bp', __name__, template_folder='templates')

admin = Admin(admin_bp)

from . import views
