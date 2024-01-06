""" Address Blueprint """
from flask import Blueprint

bp = Blueprint("address", __name__, template_folder="templates")

from . import views
