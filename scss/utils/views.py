""" This module contains the views for the utils blueprint. """
import datetime
from flask import g, render_template, request
from flask_login import login_required, current_user

from ..utils import utils_bp

@utils_bp.route('/', methods=['GET'])
def index():
    """Renders a template to display the home page."""
    if current_user.is_authenticated:
        return render_template('index.jinja2', title='[SCSS] Dashboard')
    return render_template('index.jinja2', title='Summer Camp Scheduling System')

@utils_bp.route('/home', methods=['GET'])
@login_required
def home():
    """Returns the applications home page."""
    return render_template('home.jinja2', title='Summer Camp Scheduling System')

@utils_bp.before_request
def before_request():
    """Prepare some things before the application handles a request."""
    g.request_start_time = datetime.time()
    g.request_time = lambda: '%.5fs' % (datetime.time() - g.request_start_time)
    g.pjax = 'X-PJAX' in request.headers


    