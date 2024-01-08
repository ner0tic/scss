from flask import Blueprint

bp = Blueprint('course', __name__, template_folder='templates')

from . import views