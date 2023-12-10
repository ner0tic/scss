from flask import Blueprint

organization = Blueprint('organization', __name__, template_folder='templates')

from . import views