""" Faction Blueprint """
from flask import Blueprint

bp = Blueprint("faction", __name__, template_folder="templates")

from . import views
