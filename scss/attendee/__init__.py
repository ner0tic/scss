""" attendee blueprint. """
from flask import Blueprint

attendee = Blueprint('attendee', __name__, template_folder='templates')

from . import views