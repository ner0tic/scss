from flask import Blueprint

facility = Blueprint('facility', __name__, template_folder='templates')

from . import views