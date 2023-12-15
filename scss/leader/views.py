""" This module contains the views for the leader blueprint."""
from flask import request, redirect, url_for, render_template, flash, g
from flask_babel import gettext
from flask_login import login_required
from ..utils.utils import generate_choices_from_list
from ..faction.models import Faction
from ..database import db, DataTable
from ..leader.models import Leader
from ..leader.forms import EditLeaderForm
from ..leader import leader

@leader.route("/list", methods=["GET"])
def leader_list():
    """
    Render the leader list page.

    This function renders the leader list page, which displays a table of leaders. The table is generated using the DataTable class, which provides sorting, searching, filtering, and pagination functionality. The table columns include the leader's description, first name, last name, faction ID, and creation date.

    Returns:
        rendered_template: The rendered HTML template for the leader list page.
    """

    datatable = DataTable(
        model=Leader,
        columns=[Leader.description],
        sortable=[
            Leader.first_name,
            Leader.last_name,
            Leader.faction_id,
            Leader.created_at,
        ],
        searchable=[Leader.first_name, Leader.last_name],
        filterable=[Leader.active],
        limits=[25, 50, 100],
        request=request,
    )

    if g.pjax:
        return render_template("leaders.jinja2l", datatable=datatable)

    return render_template("list.jinja2", datatable=datatable)


@leader.route("/new", methods=["GET"])
@login_required
def leader_new():
    """
    Render the new leader form.

    This function renders the new leader form, which allows the user to add a new leader. The form includes fields for the leader's details, such as name and faction. The form is rendered using the 'new.jinja2' template and requires the user to be logged in.

    Returns:
        rendered_template: The rendered HTML template for the new leader form.
    """

    form = EditLeaderForm()
    form.faction_id.choices = generate_choices_from_list(Faction.query.all())

    return render_template("new.jinja2", form=form, title="Add A Leader")


@leader.route("/new", methods=["POST"])
@login_required
def leader_new_post():
    """
    Handle the POST request for adding a new leader.

    This function handles the POST request for adding a new leader. It validates the form data, creates a new Leader object, populates it with the form data, adds it to the database session, and commits the changes. If the form validation fails, the new leader form is rendered again with the validation errors.

    Returns:
        rendered_template: The rendered HTML template for the new leader form if the form validation fails, otherwise it redirects to a success page.
    """

    form = EditLeaderForm(request.form)
    form.faction_id.choices = generate_choices_from_list(
        Faction.query.all().filterBy("Faction.parent_id == 0")
    )

    if not form.validate_on_submit():
        return render_template("new.jinja2", form=form, title="Add A Leader")

    leader_user = Leader()
    form.populate_obj(leader_user)
    db.session.add(leader_user)
    db.session.commit()
    flash(gettext("Leader added successfully!"), "success")
    return redirect(url_for("leader.leader_list"))


@leader.route("/leaders/<int:leader_id>", methods=["GET"], strict_slashes=False)
def leader_show(leader_id):
    """
    Renders a template to display the details of a specific leader.

    Args:
        leader_id: The ID of the leader to display.

    Returns:
        The rendered template for displaying the leader details.
    """
    leader_user = Leader.query().filter(Leader.id == leader_id).first()

    return render_template(
        "leader/show.jinja2", leader=leader_user, title="Leader Details"
    )
