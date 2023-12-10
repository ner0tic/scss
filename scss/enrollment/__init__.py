from flask import Blueprint

enrollment = Blueprint('enrollment', __name__, template_folder='templates')

from . import views