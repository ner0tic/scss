from flask import Blueprint

bp = Blueprint('facility', __name__, template_folder='templates')

from . import views