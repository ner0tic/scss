""" This module contains the routes for the faction blueprint. """
from flask import request, render_template, redirect, url_for, flash
from flask_login import login_required
from ..database import DataTable
from ..utils.utils import generate_choices_from_list, gettext
from ..utils.forms import DeleteConfirmationForm
from ..utils.models import Address
from ..organization.models import Organization
from .forms import FactionForm, AttendeeForm
from .models import Faction, Attendee
from ..faction import faction

def set_form_choices(form):
    """Sets the choices for the organization parent and factions in a given form.
    ToDo:
        * Move this function to the utils module.
        * Add a parameter to specify the model to use for the choices.
        * Add a parameter to specify the field to use for the choices.
        * Add a parameter to specify the order to use for the choices.
        * Add a parameter to specify the filter to use for the choices.
    Args:
        form: The form to set the choices for.
    Returns:
        None.
    """
    if 'parent' in form._fields:
        form.parent.choices = generate_choices_from_list(
                Faction.query.order_by("name")
            )
    if 'organization_id' in form._fields:
        form.organization_id.choices = generate_choices_from_list(
                Organization.query.order_by("name")
        )
    if 'faction_id' in form._fields:
        form.faction_id.choices = generate_choices_from_list(
                Faction.query.order_by("name")
        )

###################################################################################################
# Faction Related Routes ##########################################################################
###################################################################################################
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
        columns=[],
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
    """Renders a template to add a new faction.
    Returns:
        The rendered template for adding a new faction.
    """
    form = FactionForm(request.form)
    set_form_choices(form)

    if request.method == 'POST':
        if form.validate():
#            addr = Address.create(
#            line1=form.data['address_id']['line1'],
#            line2=form.data['address_id']['line2'],
#            city=form.data['address_id']['city'],
#            state=form.data['address_id']['state'],
#            postal_code=form.data['address_id']['postal_code'],
#            country=form.data['address_id']['country'])

            fac = Faction.create(
                name = form.name.data,
                short_name = form.short_name.data,
                description = form.description.data,
                avatar_url = form.avatar_url.data,
                organization_id = form.organization_id.data,
                parent_id = form.parent.data if form.parent.data != 0 else None,)
#                address_id = addr.id)
            
            flash("Faction added successfully!")
            return render_template("faction_show.jinja2", faction=fac)
        else:
            for field, errors in form.errors.items():
                for error in errors:
                    flash(f"Error in field '{field}': {error}")
    return render_template("faction_manage.jinja2", form=form)

@faction.route("/factions/<int:id>/manage", methods=["GET", "POST"])
@login_required
def faction_manage(id):
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

    return render_template("faction_manage.jinja2", form=form, faction=fac)

@faction.route('/factions/<int:id>/delete', methods=['GET', 'POST'])
def faction_delete(id):
    """
    Delete a faction.

    Args:
        id: The ID of the faction to delete.

    Returns:
        Union[Response, str]: A redirect response or a rendered template.
    """
    form = DeleteConfirmationForm(request.form)
    form.id = id

    if request.method == 'POST' and form.validate():
        if form.confirm.data:
            # Remove all child organizations, factions, attendees, enrollments, and events
            fac = Faction.query.get_or_404(id)
            fac.delete()

            flash('Faction deleted successfully.', 'success')
        else:

            flash('Faction deletion cancelled.')
        return redirect(url_for('organization.organization_list'))
    return render_template('organization_delete.jinja2', form=form)

###################################################################################################
# Attendee Related Routes #########################################################################
###################################################################################################
@faction.route("/attendees", methods=["GET"], strict_slashes=False)
def attendee_list():
    """Renders a template to display a list of attendees.
    Returns:
        The rendered template for displaying the list of attendees.
    Raises:
        None.
    """

    datatable = DataTable(
        model=Attendee,
        columns=[],
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

#    if g.pjax:
#        return render_template("attendees.jinja2l", datatable=datatable)

    return render_template("attendee_list.jinja2", datatable=datatable)

@faction.route("/attendees/<int:id>", methods=["GET"], strict_slashes=False)
def attendee_show(id):
    """Renders a template to display the details of a specific attendee.
        Args:
            id: The ID of the attendee to display.

        Returns:
            The rendered template for displaying the attendee details.
    """
    att = Attendee.query.get_or_404(id)
    return render_template("show.jinja2", attendee=att)

@faction.route("/attendees/add", methods=["GET", "POST"])
@login_required
def attendee_add():
    """Renders a template to add a new attendee.
    Returns:
        The rendered template for adding a new attendee.
    """
    form = AttendeeForm(request.form)
    set_form_choices(form)
    if request.method == "POST":
        if form.validate():
            addr = Address.create(
                line1=form.data['address_id']['line1'],
                line2=form.data['address_id']['line2'],
                city=form.data['address_id']['city'],
                state=form.data['address_id']['state'],
                postal_code=form.data['address_id']['postal_code'],
                country=form.data['address_id']['country'])

            att = Attendee.create(
                first_name = form.first_name.data,
                last_name = form.last_name.data,
                username = form.username.data,
                email = form.email.data,
                password = form.password.data,
                role = 'attendee',
                address_id = addr.id,
                avatar_url = form.avatar_url.data,
                organization_id = form.organization_id.data,
                faction_id = form.faction_id.data,)

            flash("Attendee added successfully!")
            return render_template("attendee_show.jinja2", attendee=att)
        else:
            for field, errors in form.errors.items():
                for error in errors:
                    flash(f"Error in field '{field}': {error}")
    return render_template("attendee_manage.jinja2", form=form)

@faction.route("/attendees/<int:id>/manage", methods=["GET", "POST"], strict_slashes=False)
@login_required
def attendee_manage(id):
    """Edit the details of an attendee.

    Args:
        id: The ID of the attendee to edit.

    Returns:
        The rendered template for editing the attendee details.

    """

    att = Attendee.get_or_404(id)
    form = AttendeeForm(obj=att)
    set_form_choices(form)
    
    if form.validate_on_submit():
        att.first_name = form.first_name.data
        att.last_name = form.last_name.data
        att.username = form.username.data
        att.role = 'attendee'
        att.avatar_url = form.avatar_url.data
        att.organization_id = form.organization.data
        att.faction_id = form.faction.data
        att.save()

        flash("Attendee updated successfully!")
        return render_template("attendee_show.jinja2", attendee=att)

    return render_template("attendee_manage.jinja2", form=form, attendee=att)

@faction.route('/attendees/<int:id>/delete', methods=['GET', 'POST'])
def attendee_delete(id):
    form = DeleteConfirmationForm(request.form)
    form.id = id

    if request.method == 'POST' and form.validate():
        if form.confirm.data:
            att = Attendee.query.get_or_404(id)
            att.delete()

            flash('Attendee deleted successfully.', 'success')
        else:

            flash('Attendee deletion cancelled.')
        return redirect(url_for('faction.attendee_list'))
    return render_template('attendee_delete.jinja2', form=form)
