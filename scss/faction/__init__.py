from flask import Blueprint

faction = Blueprint(
    'faction',
    __name__,
    template_folder='templates')

from . import views