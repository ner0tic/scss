from flask import Blueprint

bp = Blueprint('enrollment', __name__, template_folder='templates')

from . import views