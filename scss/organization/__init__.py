""" Organization Blueprint """
from flask import Blueprint

bp = Blueprint("organization", __name__, template_folder="templates")

from . import views
