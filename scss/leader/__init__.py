from flask import Blueprint

leader = Blueprint('leader', __name__, template_folder='templates')

from . import views