""" Faction Related Views. """
from flask import request, render_template, redirect, url_for, flash
from flask_login import login_required

from ..database import DataTable
from ..utils.forms import DeleteConfirmationForm,set_form_choices

from ..organization.models.organization import Organization
from ..faction import bp as fac_bp

from .models.faction import Faction
from .models.attendee import Attendee
from .models.leader import Leader
from .forms import FactionForm, AttendeeForm, LeaderForm


###################################################################################################
# Faction Related Routes ##########################################################################
###################################################################################################
@fac_bp.route("/factions", methods=["GET"], strict_slashes=False)
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


@fac_bp.route("/factions/<int:id>", methods=["GET"], strict_slashes=False)
def faction_show(id):
    """Renders a template to display the details of a specific faction.
        Args:
            id: The ID of the faction to display.

        Returns:
            The rendered template for displaying the faction details.
    """
    fac = Faction.query.get_or_404(id)
    return render_template("faction_show.jinja2", faction=fac)


@fac_bp.route('/factions/add', methods=['GET', 'POST'])
@login_required
def faction_add():
    """Renders a template to add a new faction.
    Returns:
        The rendered template for adding a new faction.
    """
    form = FactionForm(request.form)
    set_form_choices(form, {
        'organization_id': Organization.query.all(),
        'parent_id': Faction.query.all()
    })

    if request.method == 'POST':
        if form.validate():
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


@fac_bp.route("/factions/<int:id>/manage", methods=["GET", "POST"])
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


@fac_bp.route('/factions/<int:id>/delete', methods=['GET', 'POST'])
@login_required
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
            fac = Faction.query.get_or_404(id)
            fac.delete()

            flash('Faction deleted successfully.', 'success')
        else:

            flash('Faction deletion cancelled.')
        return redirect(url_for('faction.faction_list'))
    return render_template('delete.jinja2', form=form)


###################################################################################################
# Attendee Related Routes #########################################################################
###################################################################################################
@fac_bp.route("/attendees", methods=["GET"], strict_slashes=False)
@login_required
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


@fac_bp.route("/attendees/<int:id>", methods=["GET"], strict_slashes=False)
@login_required
def attendee_show(id):
    """Renders a template to display the details of a specific attendee.
        Args:
            id: The ID of the attendee to display.

        Returns:
            The rendered template for displaying the attendee details.
    """
    att = Attendee.query.get_or_404(id)
    return render_template("show.jinja2", attendee=att)


@fac_bp.route("/attendees/add", methods=["GET", "POST"])
@login_required
def attendee_add():
    """Renders a template to add a new attendee.
    Returns:
        The rendered template for adding a new attendee.
    """
    form = AttendeeForm(request.form)
    set_form_choices(form, {
        'organization_id': Organization.query.all(),
        'faction_id': Faction.query.all()
    })

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


@fac_bp.route("/attendees/<int:id>/manage", methods=["GET", "POST"], strict_slashes=False)
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
    set_form_choices(form, {
        'organization_id': Organization.query.all(),
        'faction_id': Faction.query.all()
    })
    
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


@fac_bp.route('/attendees/<int:id>/delete', methods=['GET', 'POST'])
@login_required
def attendee_delete(id):
    """
    Delete an attendee.
    
    Args:
        id: The ID of the attendee to delete.
        
    Returns:

    """
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
    return render_template('delete.jinja2', form=form)


###################################################################################################
# Leader Related Routes ###########################################################################
###################################################################################################
@fac_bp.route("/leaders", methods=["GET"], strict_slashes=False)
@login_required
def leader_list():
    """Renders a template to display a list of leaders.
    Returns:
        The rendered template for displaying the list of leaders.
    Raises:
        None.
    """

    datatable = DataTable(
        model=Leader,
        columns=[],
        sortable=[
            Leader.first_name,
            Leader.last_name,
            Leader.faction_id,
            Leader.organization_id,
            Leader.created_at,
        ],
        searchable=[Leader.last_name, Leader.first_name],
        filterable=[Leader.faction_id, Leader.organization_id],
        limits=[25, 50, 100],
        request=request,
    )

#    if g.pjax:
#        return render_template("leaders.jinja2", datatable=datatable)

    return render_template("leader_list.jinja2", datatable=datatable)


@fac_bp.route("/leaders/<int:id>", methods=["GET"], strict_slashes=False)
@login_required
def leader_show(id):
    """Renders a template to display the details of a specific leader.
        Args:
            id: The ID of the leader to display.

        Returns:
            The rendered template for displaying the leader details.
    """
    lead = Leader.query.get_or_404(id)
    return render_template("leader_show.jinja2", leader=lead)


@fac_bp.route("/leaders/add", methods=["GET", "POST"])
@login_required
def leader_add():
    """Renders a template to add a new leader.
    Returns:
        The rendered template for adding a new leader.
    """
    form = LeaderForm(request.form)
    set_form_choices(form, {
        'organization_id': Organization.query.all(),
        'faction_id': Faction.query.all()
    })

    if request.method == "POST":
        if form.validate():
            addr = Address.create(
                line1=form.data['address_id']['line1'],
                line2=form.data['address_id']['line2'],
                city=form.data['address_id']['city'],
                state=form.data['address_id']['state'],
                postal_code=form.data['address_id']['postal_code'],
                country=form.data['address_id']['country'])

            lead = Leader.create(
                first_name = form.first_name.data,
                last_name = form.last_name.data,
                username = form.username.data,
                email = form.email.data,
                password = form.password.data,
                role = 'leader',
                address_id = addr.id,
                avatar_url = form.avatar_url.data,
                organization_id = form.organization_id.data,
                faction_id = form.faction_id.data,)

            flash("Leader added successfully!")
            return render_template("leader_show.jinja2", leader=lead)
        else:
            msg = ''
            for field, errors in form.errors.items():
                for error in errors:
                    msg += f"Error in field '{field}': {error}"
            flash(msg)
    return render_template("leader_manage.jinja2", form=form)


@fac_bp.route("/leaders/<int:id>/manage", methods=["GET", "POST"], strict_slashes=False)
@login_required
def leader_manage(id):
    """Edit the details of a leader.

    Args:
        id: The ID of the leader to edit.

    Returns:
        The rendered template for editing the leader details.

    """

    lead = Leader.get_or_404(id)
    form = LeaderForm(obj=lead)
    set_form_choices(form, {
        'organization_id': Organization.query.all(),
        'faction_id': Faction.query.all()
    })

    if form.validate_on_submit():
        lead.first_name = form.first_name.data
        lead.last_name = form.last_name.data
        lead.username = form.username.data
        lead.role = 'leader'
        lead.avatar_url = form.avatar_url.data
        lead.organization_id = form.organization.data
        lead.faction_id = form.faction.data
        lead.save()

        flash("Leader updated successfully!")
        return render_template("leader_show.jinja2", leader=lead)

    return render_template("leader_manage.jinja2", form=form, leader=lead)


@fac_bp.route('/leaders/<int:id>/delete', methods=['GET', 'POST'])
@login_required
def leader_delete(id):
    """
    Delete a leader.
    
    Args:
        id: The ID of the leader to delete.
        
    Returns:

    """
    form = DeleteConfirmationForm(request.form)
    form.id = id

    if request.method == 'POST' and form.validate():
        if form.confirm.data:
            lead = Leader.query.get_or_404(id)
            lead.delete()

            flash('Leader deleted successfully.', 'success')
        else:

            flash('Leader deletion cancelled.')
        return redirect(url_for('faction.leader_list'))
    return render_template('delete.jinja2', form=form)
