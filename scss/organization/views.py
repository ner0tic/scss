from flask import request, redirect, url_for, render_template, flash, g
from flask_babel import gettext
from flask_login import login_required
from scss.organization.models import Organization
from scss.organization.models import Organization
from scss.utils import generate_choices_from_list
from .forms import EditOrganizationForm

from ..organization import organization

@organization.route('/list', methods=['GET'])
def organization_list():
    """Renders a template to display a list of organizations.
    Returns:
        The rendered template for displaying the list of organizations.
    """

    return render_template("list.jinja2",
                            organizations=Organization.query().all(),
                            title="All Organizations")
    
@app.route("/organizations/<int:organization_id>", methods=["GET"], strict_slashes=False)
def organization_show(organization_id):
    """Renders a template to display the details of a specific organization.
    Args:
        organization_id: The ID of the organization to display.
    Returns:
        The rendered template for displaying the organization details.
    """

    return render_template("organization/show.jinja2",
                            organization=session.query(models.Organization).filter(models.Organization.id == organization_id).first(),
                            title="Organization Details")

@app.route("/organizations/<int:organization_id>/edit", methods=["GET", "POST"], strict_slashes=False)
def organization_edit(organization_id):
    # @TODO: Implement organization editing
    pass

@app.route("/organizations/<int:organization_id>/delete", methods=["GET", "POST"], strict_slashes=False)
def organization_delete(organization_id):
    """Renders a template to delete an organization based on the provided organization ID.
    Args:
        organization_id: The ID of the organization to delete.
    Returns:
        The rendered template for deleting the organization.
    Raises:
        None.
    """

    msg = None
    form = forms.DeleteConfirmationForm(request.form)
    form.id = organization_id
    
    if request.method == "POST" and form.validate():
        if form.confirm.data:
            # Remove all child organizations, factions, attendees, enrollments, and events
            # @todo: implement removal of all child-related objects
            # Remove Organization
            session.query(models.Organization).filter(models.Organization.id == organization_id).delete()
            session.commit()
            msg = "Organization deleted successfully!"
        else:
            msg = "Organization deletion cancelled!"

        organizations = session.query(models.Organization).all()
        return render_template("organization/list.jinja2",
                                organizations=organizations,
                                title="All Organizations",
                                msg=msg)

    organization = session.query(models.Organization).filter(models.Organization.id == organization_id).first()
    return render_template("delete.jinja2",
                            organization=organization,
                            form=form,
                            title="Delete Organization",
                            msg=msg)
    
@app.route("/organizations/add", methods=["GET", "POST"], strict_slashes=False)
def organization_add():
    """Renders a template to add a new organization.
    Returns:
        The rendered template for adding a new organization.
    """

    organization = models.Organization()
    msg = None

    def set_form_choices(form):
        """Sets the choices for the organization parent and factions in a given form.
        Args:
            form: The form to set the choices for.
        Returns:
            None.
        """

        form.organization_parent.choices = generate_choices_from_list(session.query(models.Organization).order_by('name'))
        form.organization_factions.choices = generate_choices_from_list([])

    if request.method == "POST":
        form = forms.OrganizationAddForm(request.form)
        set_form_choices(form)

        # Check for unique organization name (at root level)
        if session.query(Organization).filter(
                and_(models.Organization.name == form.name.data, models.Organization.parent_id == None)
            ).first():
            msg = "An organization with that name already exists!"
            return render_template("organization/add.jinja2", form=form, msg=msg)

        # Validate the form data
        if form.validate():
            organization.name = form.organization_name.data
            organization.short_name = form.organization_short_name.data
            organization.description = form.organization_description.data
            organization.parent_id = None if form.organization_parent.data == 0 else form.organization_parent.data
            organization.factions = []

            session.add(organization)
            session.commit()
            msg = "Organization added successfully!"
            return render_template("organization/show.jinja2", organization=organization, msg=msg)
    else:
        form = forms.OrganizationAddForm(obj=organization)
        set_form_choices(form)

    return render_template("organization/add.jinja2",
                            form=form,
                            title="Add Organization",
                            msg=msg)