""" This module contains the views for the organization blueprint. """
from flask import request, redirect, url_for, render_template, flash, g
from flask_babel import gettext
from flask_login import login_required
from sqlalchemy import and_
from ..database import DataTable
from ..utils.utils import generate_choices_from_list
from ..utils.forms import DeleteConfirmationForm
from .models import Organization
from .forms import EditOrganizationForm, OrganizationAddForm
from ..organization import organization

@organization.route("/list", methods=["GET"])
def organization_list():
    """
    Render the organization list page.

    This function renders the organization list page, which displays a table of organizations. The table is generated using the DataTable class, which provides sorting, searching, filtering, and pagination functionality. The table columns include the organization's description, name, short name, parent ID, and creation date.

    Returns:
        rendered_template: The rendered HTML template for the organization list page.
    """

    datatable = DataTable(
        model=Organization,
        columns=[Organization.description],
        sortable=[
            Organization.name,
            Organization.short_name,
            Organization.parent_id,
            Organization.created_at,
        ],
        searchable=[Organization.name, Organization.short_name],
        filterable=[Organization.active],
        limits=[25, 50, 100],
        request=request,
    )

    if g.pjax:
        return render_template("organizations.jinja2l", datatable=datatable)

    return render_template("list.jinja2", datatable=datatable)


@organization.route(
    "/organizations/<int:organization_id>", methods=["GET"], strict_slashes=False
)
def organization_show(organization_id):
    """Renders a template to display the details of a specific organization.
    Args:
        organization_id: The ID of the organization to display.
    Returns:
        The rendered template for displaying the organization details.
    """

    return render_template(
        "show.jinja2",
        organization=Organization.query()
        .filter(Organization.id == organization_id)
        .first(),
        title="Organization Details",
    )


@organization.route(
    "/organizations/<int:organization_id>/edit",
    methods=["GET", "POST"],
    strict_slashes=False,
)
def organization_edit(organization_id):
    """
    Edit an organization.

    This function handles the editing of an organization based on the provided organization ID. It retrieves the organization from the database, populates an EditOrganizationForm with the organization's data, and renders the edit template. If the form is submitted and passes validation, the organization's data is updated and saved to the database. Finally, the function redirects to the organization's details page.

    Args:
        organization_id: The ID of the organization to edit.

    Returns:
        rendered_template: The rendered HTML template for editing the organization.
    """

    org = Organization.query().filter(Organization.id == organization_id).first()
    form = EditOrganizationForm(obj=org)

    if request.method == "POST" and form.validate():
        org.name = form.name.data
        org.short_name = form.short_name.data
        org.description = form.description.data
        org.parent_id = form.parent_id.data
        org.factions = form.factions.data

        org.save()
        flash(gettext("Organization updated successfully!"), "success")
        return redirect(
            url_for("organization.organization_show", organization_id=org.id)
        )

    return render_template("edit.jinja2", form=form, title="Edit Organization")


@organization.route(
    "/organizations/<int:organization_id>/delete",
    methods=["GET", "POST"],
    strict_slashes=False,
)
def organization_delete(organization_id):
    """Renders a template to delete an organization based on the provided organization ID.
    Args:
        organization_id: The ID of the organization to delete.
    Returns:
        The rendered template for deleting the organization.
    Raises:
        None.
    """

    form = DeleteConfirmationForm(request.form)
    form.id = organization_id

    if request.method == "POST" and form.validate():
        if form.confirm.data:
            # Remove all child organizations, factions, attendees, enrollments, and events
            # @todo: implement removal of all child-related objects
            # Remove Organization
            Organization.query().filter(Organization.id == organization_id).delete()
            flash("Organization deleted successfully!")
        else:
            flash("Organization deletion cancelled!")
        redirect(url_for("organization.organization_list"))

    org = Organization.query().filter(Organization.id == organization_id).first()
    return render_template(
        "delete.jinja2",
        organization=org,
        form=form,
        title="Delete Organization",
    )


@organization.route("/organizations/add", methods=["GET", "POST"], strict_slashes=False)
@login_required
def organization_add():
    """Renders a template to add a new organization.
    Returns:
        The rendered template for adding a new organization.
    """

    org = Organization()

    def set_form_choices(form):
        """Sets the choices for the organization parent and factions in a given form.
        Args:
            form: The form to set the choices for.
        Returns:
            None.
        """

        form.organization_parent.choices = generate_choices_from_list(
            Organization.query().order_by("name")
        )
        form.organization_factions.choices = generate_choices_from_list()

    if request.method == "POST":
        form = OrganizationAddForm(request.form)
        set_form_choices(form)

        # Check for unique organization name (at root level)
        if Organization.filter(
            and_(
                Organization.name == form.name.data,
                Organization.parent_id is None,
            )
        ).first():
            msg = "An organization with that name already exists!"
            return render_template("add.jinja2", form=form, msg=msg)

        # Validate the form data
        if form.validate():
            org.name = form.organization_name.data
            org.short_name = form.organization_short_name.data
            org.description = form.organization_description.data
            org.parent_id = (
                None
                if form.organization_parent.data == 0
                else form.organization_parent.data
            )
            org.factions = []

            org.save()
            flash("Organization added successfully!")
            return render_template(
                "show.jinja2", organization=org, title=f"{org.name} Details"
            )
    else:
        form = OrganizationAddForm(obj=org)
        set_form_choices(form)

    return render_template(
        "add.jinja2", form=form, title="Add Organization"
    )
