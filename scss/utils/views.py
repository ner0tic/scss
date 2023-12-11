from flask import request, redirect, url_for, render_template, flash, g
from flask_babel import gettext
from flask_login import login_required
from ..utils.models import Address
# from scss.utils import generate_choices_from_list
from .forms import EditAddressForm

from ..utils import utils

@utils.route('/list', methods=['GET'])
@login_required
def address_list():
    """Renders a template to display a list of organizations.
    Returns:
        The rendered template for displaying the list of organizations.
    """

    return render_template("list.jinja2",
                            addresses=Address.query().all(),
                            title="All Addresses")
    