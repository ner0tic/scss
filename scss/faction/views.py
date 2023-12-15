""" This module contains the routes for the faction blueprint. """
from flask import request, redirect, url_for, render_template, flash, g
from flask_babel import gettext
from flask_login import login_required
from ..database import DataTable
from ..utils.utils import generate_choices_from_list
from ..utils.forms import DeleteConfirmationForm
from ..utils.models import Address
from ..faction.forms import FactionAddForm, EditFactionForm
from ..faction.models import Faction
from ..faction import faction

# Faction Related Routes
@faction.route("/factions/", methods=["GET"], strict_slashes=False)
def faction_list():
    """Renders a template to display a list of factions.
    Returns:
        The rendered template for displaying the list of factions.
    Raises:
        None.
    """

    datatable = DataTable(
        model=Faction,
        columns=[Faction.description],
        sortable=[
            Faction.name,
            Faction.short_name,
            Faction.parent_id,
            Faction.created_at,
        ],
        searchable=[Faction.name, Faction.short_name],
        filterable=[],
        limits=[25, 50, 100],
        request=request,
    )

    if g.pjax:
        return render_template("organizations.jinja2l", datatable=datatable)

    return render_template("list.jinja2", datatable=datatable)

@faction.route("/factions/<int:faction_id>", methods=["GET"], strict_slashes=False)
def faction_detail(faction_id):
    """Renders a template to display the details of a specific faction.
        Args:
            faction_id: The ID of the faction to display.

        Returns:
            The rendered template for displaying the faction details.
    """

    return render_template("faction/show.jinja2",
                            faction=Faction.query().filter(Faction.id == faction_id).first(),
                            title="Faction Details")
    
@faction.route("/factions/<int:faction_id>/edit", methods=["GET", "POST"], strict_slashes=False)
@login_required
def faction_edit(faction_id):
    pass

@faction.route("/factions/<int:faction_id>/delete", methods=["GET"], strict_slashes=False)
@login_required
def faction_delete_get(faction_id):
    """Handles the GET request to display the delete confirmation page for a faction.
    Args:
        faction_id: The ID of the faction to delete.
    Returns:
        The rendered template for the delete confirmation page.

    """

    form = forms.DeleteConfirmationForm(request.form)
    form.id = faction_id
    return render_template("delete.jinja2",
                            faction=Faction.query().filter(Faction.id == faction_id).first(),
                            form=form,
                            title="Delete Faction")

@faction.route("/factions/<int:faction_id>/delete", methods=["POST"], strict_slashes=False)
@login_required
def faction_delete_post(faction_id):
    """Handles the POST request to delete a faction.
    Args:
        faction_id: The ID of the faction to delete.
    Returns:
        The rendered template for displaying the list of factions after deletion.
    """

    form = forms.DeleteConfirmationForm(request.form)
    form.id = faction_id
    if not form.validate() or not form.confirm.data:
        msg = "Faction deletion cancelled!"
        return render_template("faction/list.jinja2",
                                factions=Faction.query().all(),
                                title="All Factions",
                                msg=msg)

    # Remove all child factions, attendees, enrollments, and events
    # @todo: implement removal of all child-related objects
    # Remove Faction
    Faction.query().filter(Faction.id == faction_id).delete()
    session.commit()
    msg = "Faction deleted successfully!"
    return render_template("faction/list.jinja2",
                            factions=Faction.query().all(),
                            title="All Factions",
                            msg=msg)

@faction.route("/factions/add", methods=["GET", "POST"], strict_slashes=False)
def faction_add():
    """Renders a template to add a new faction.
    Returns:
        The rendered template for adding a new faction.
    """

    faction = Faction()
    msg = None
    form = forms.FactionAddForm(request.form) if request.method == "POST" else forms.FactionAddForm(obj=faction)
    form.organization_id.choices = generate_choices_from_list(session.query(Organization).order_by('name'))
    form.parent.choices = generate_choices_from_list(Faction.query().order_by('name'))

    if request.method == "POST" and form.validate():
        faction.name = form.name.data
        faction.short_name = form.short_name.data
        faction.description = form.description.data
        faction.avatar_url = form.avatar_url.data
        faction.organization_id = form.organization_id.data
        faction.parent_id = form.parent.data if form.parent.data != 0 else None

        session.add(faction)
        session.commit()
        msg = "Faction added successfully!"
        added_faction = Faction.query().filter(Faction.name == faction.name, Faction.short_name == faction.short_name).first()
        return render_template("show.jinja2", faction=added_faction, msg=msg)

    return render_template("faction/add.jinja2", 
                            form=form,
                            title="Add Faction")

