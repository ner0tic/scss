""" This module contains the views for the utils blueprint. """
import datetime
from flask import g, render_template, request
#from flask_babel import gettext
from flask_login import login_required, current_user
from ..utils.models import Address
from .utils import gettext
# from scss.utils import generate_choices_from_list
from .forms import AddressForm

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

@utils_bp.route('/list', methods=['GET'])
@login_required
def address_list():
    """Renders a template to display a list of organizations.
    Returns:
        The rendered template for displaying the list of organizations.
    """

    return render_template("list.jinja2",
                            addresses=Address.query().all(),
                            title=gettext("All Addresses"))
    