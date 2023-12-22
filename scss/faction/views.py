""" This module contains the routes for the faction blueprint. """
from flask import request, render_template, flash, g
#from flask_babel import gettext
from flask_login import login_required
from ..database import DataTable
from ..utils.utils import generate_choices_from_list, gettext
from ..utils.forms import DeleteConfirmationForm
from ..organization.models import Organization
from .forms import FactionForm, AttendeeForm
from .models import Faction, Attendee
from ..faction import faction

def set_form_choices(form):
    """Sets the choices for the organization parent and factions in a given form.
    Args:
        form: The form to set the choices for.
    Returns:
        None.
    """
    form = FactionForm()
    form.parent.choices = generate_choices_from_list(
            Organization.query.order_by("name")
        )
    form.factions.choices = generate_choices_from_list()


# Faction Related Routes ##########################################################################
@faction.route("/factions", methods=["GET"], strict_slashes=False)
def faction_list():
    """
    Render the faction list page.

    This function renders the faction list page, which displays a table of factions. The table is generated using the DataTable class, which provides sorting, searching, filtering, and pagination functionality. The table columns include the faction's description, name, short name, organization ID, and creation date.

    Returns:
       rendered_template: The rendered HTML template for the faction list page.
    """

    datatable = DataTable(
        model=Faction,
        columns=[Faction.description],
        sortable=[
            Faction.name,
            Faction.short_name,
            Faction.organization_id,
            Faction.parent_id,
            Faction.created_at,
        ],
        searchable=[Faction.name, Faction.short_name],
        filterable=[Faction.parent_id, Faction.organization_id],
        limits=[25, 50, 100],
        request=request,
    )

#    if g.pjax:
#       return render_template("factions.jinja2", datatable=datatable)

    return render_template("faction_list.jinja2", datatable=datatable, title=gettext("Faction"), )

@faction.route("/factions/<int:id>", methods=["GET"], strict_slashes=False)
def faction_show(id):
    """Renders a template to display the details of a specific faction.
        Args:
            id: The ID of the faction to display.

        Returns:
            The rendered template for displaying the faction details.
    """
    fac = Faction.query.get_or_404(id)
    return render_template("faction_show.jinja2", faction=fac)

@faction.route('/factions/add', methods=['GET', 'POST'])
@login_required
def faction_add():
    if request.method == 'POST':
        form = FactionForm(request.form)
        set_form_choices(form)

        if form.validate():
            fac = Faction()
            fac.name = form.name.data
            fac.short_name = form.short_name.data
            fac.description = form.description.data
            fac.avatar_url = form.avatar_url.data
            fac.organization_id = form.organization_id.data
            fac.parent_id = form.parent.data if form.parent.data != 0 else None
            fac.attendees = []
            fac.leaders = []
            fac.create()

            flash("Faction added successfully!")
            return render_template("faction_show.jinja2", faction=fac)
    form = FactionForm()
    set_form_choices(form)
    return render_template("faction_manage.jinja2", form=form)

@faction.route("/factions/<int:id>/manage", methods=["GET", "POST"])
@login_required
def faction_edit(id):
    """Edit the details of a faction.

    Args:
        id: The ID of the faction to edit.

    Returns:
        The rendered template for editing the faction details.
    """

    fac = Faction.query.get_or_404(id)
    form = FactionForm(obj=fac)
    set_form_choices(form)
    
    if form.validate_on_submit():
        fac.name = form.name.data
        fac.short_name = form.short_name.data
        fac.description = form.description.data
        fac.avatar_url = form.avatar_url.data
        fac.organization_id = form.organization.data
        fac.parent_id = form.parent.data if form.parent.data != 0 else None
        fac.save()

        flash("Faction updated successfully!")
        return render_template("faction_show.jinja2", faction=fac)

    return render_template("faction_manage.jinja2", form=form)

@faction.route("/factions/<int:id>/delete", methods=["GET"], strict_slashes=False)
@login_required
def faction_delete_get(id):
    """Handles the GET request to display the delete confirmation page for a faction.
    Args:
        id: The ID of the faction to delete.
    Returns:
        The rendered template for the delete confirmation page.

    """

    form = DeleteConfirmationForm(request.form)
    form.id = id
    return render_template("delete.jinja2",
                            faction=Faction.query.filter(id == id).first(),
                            form=form,
                            title="Delete Faction")

@faction.route("/factions/<int:id>/delete", methods=["POST"], strict_slashes=False)
@login_required
def faction_delete_post(id):
    """Handles the POST request to delete a faction.
    Args:
        id: The ID of the faction to delete.
    Returns:
        The rendered template for displaying the list of factions after deletion.
    """

    form = DeleteConfirmationForm(request.form)
    form.id = id
    if not form.validate() or not form.confirm.data:
        flash("Faction deletion cancelled!")
        return render_template("list.jinja2",
                                factions=Faction.query.all(),
                                title=gettext("All Factions"))

    # Remove all child factions, attendees, enrollments, and events
    # @todo: implement removal of all child-related objects
    # Remove Faction
    Faction.query.filter(id == id).delete()

    flash("Faction deleted successfully!")
    return render_template("list.jinja2",
                            factions=Faction.query.all(),
                            title=gettext("All Factions"))

# Attendee Related Routes #########################################################################
@faction.route("/attendees/", methods=["GET"], strict_slashes=False)
def attendee_index():
    """Renders a template to display a list of attendees.
    Returns:
        The rendered template for displaying the list of attendees.
    Raises:
        None.
    """

    datatable = DataTable(
        model=Attendee,
        columns=[Attendee.description],
        sortable=[
            Attendee.first_name,
            Attendee.last_name,
            Attendee.faction_id,
            Attendee.organization_id,
            Attendee.created_at,
        ],
        searchable=[Attendee.last_name, Attendee.first_name],
        filterable=[Attendee.faction_id, Attendee.organization_id],
        limits=[25, 50, 100],
        request=request,
    )

    if g.pjax:
        return render_template("attendees.jinja2l", datatable=datatable)

    return render_template("list.jinja2", datatable=datatable)

@faction.route("/attendees/<int:id>", methods=["GET"], strict_slashes=False)
def attendee_show(id):
    """Renders a template to display the details of a specific attendee.
        Args:
            id: The ID of the attendee to display.

        Returns:
            The rendered template for displaying the attendee details.
    """

    return render_template("show.jinja2",
                            attendee=Attendee.query.filter(id == id).first(),
                            title=gettext("Attendee Details"))

@faction.route("/attendees/<int:id>/edit", methods=["GET", "POST"], strict_slashes=False)
@login_required
def attendee_edit(id):
    """Edit the details of an attendee.

    Args:
        id: The ID of the attendee to edit.

    Returns:
        The rendered template for editing the attendee details.

    """

    att = Attendee.query.filter_by(id == id).first()
    form = AttendeeForm(obj=att)

    return render_template("edit.jinja2", form=form, title=gettext("Edit Attendee"))

@faction.route("/attendees/<int:id>/delete", methods=["GET"], strict_slashes=False)
@login_required
def attendee_delete_get(id):
    """Handles the GET request to display the delete confirmation page for a attendee.
    Args:
        id: The ID of the attendee to delete.
    Returns:
        The rendered template for the delete confirmation page.

    """

    form = DeleteConfirmationForm(request.form)
    form.id = id
    return render_template("delete.jinja2",
                            attendee=Attendee.query.filter(Attendee.id == id).first(),
                            form=form,
                            title=gettext("Delete Attendee"))

@faction.route("/attendees/<int:id>/delete", methods=["POST"], strict_slashes=False)
@login_required
def attendee_delete_post(id):
    """Handles the POST request to delete a attendee.
    Args:
        id: The ID of the attendee to delete.
    Returns:
        The rendered template for displaying the list of attendees after deletion.
    """

    form = DeleteConfirmationForm(request.form)
    form.id = id
    if not form.validate() or not form.confirm.data:
        flash("Attendee deletion cancelled!")
        return render_template("list.jinja2",
                                attendees=Attendee.query.all(),
                                title=gettext("All Attendees"))

    # Remove all child attendees, attendees, enrollments, and events
    # @todo: implement removal of all child-related objects
    # Remove Attendee
    Attendee.query.filter_by(id == id).delete()
    
    flash("Attendee deleted successfully!")
    return render_template("list.jinja2",
                            attendees=Attendee.query.all(),
                            title=gettext("All Attendees"))

@faction.route("/attendees/add", methods=["GET", "POST"], strict_slashes=False)
def attendee_add():
    """Renders a template to add a new attendee.
    Returns:
        The rendered template for adding a new attendee.
    """

    att = Attendee()
    form = AttendeeForm(request.form) if request.method == "POST" else AttendeeForm(obj=att)
    form.organization_id.choices = generate_choices_from_list(Organization.query.order_by('name'))
    form.faction_id.choices = generate_choices_from_list(Faction.query.order_by('name'))

    if request.method == "POST" and form.validate():
        att.first_name = form.first_name.data
        att.last_name = form.last_name.data
        att.username = form.username.data
        att.role = 'attendee'
        att.avatar_url = form.avatar_url.data
        att.organization_id = form.organization_id.data
        att.faction_id = form.faction.data # if form.faction.data != 0 else None
        att.save()

        flash("Attendee added successfully!")
        return render_template("show.jinja2", attendee=att, title=f"{att.first_name} {att.last_name} Details")

    return render_template("attendee/add.jinja2",
                            form=form,
                            title=gettext("Add Attendee"))
