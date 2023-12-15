from flask import Blueprint

utils_bp = Blueprint('utils_bp', __name__, template_folder='templates')

from . import views
from . import utils