""" This module contains the views for the organization blueprint."""
from flask import request, render_template, redirect, url_for, flash
from flask_login import login_required
import slug
from sqlalchemy import and_
from .models import Organization
from .forms import OrganizationForm
from ..database import DataTable
from ..utils.forms import DeleteConfirmationForm
from ..utils.utils import set_form_choices, generate_choices_from_list
from ..organization import organization


def index():
    organizations = Organization.query.all()
    return render_template("organization_list.jinja2", organizations=organizations)


@organization.route("/organizations", methods=["GET"], strict_slashes=False)
def organization_list():
    """
    Render the organization list page.

    This function renders the organization list page, which displays a table of organizations. The table is generated using the DataTable class, which provides sorting, searching, filtering, and pagination functionality. The table columns include the organization's description, name, short name, parent ID, and creation date.

    Returns:
        rendered_template: The rendered HTML template for the organization list page.
    """

    datatable = DataTable(
        model=Organization,
        columns=["Name", "Abbreviation", "Description", "Parent", "Created At"],
        sortable=[
            Organization.name,
            Organization.short_name,
            Organization.description,
            Organization.parent_id,
            Organization.created_at,
        ],
        searchable=[Organization.name, Organization.short_name],
        filterable=[],  # Organization.active],
        limits=[25, 50, 100],
        request=request,
    )

    #    if g.pjax:
    #        return render_template("organizations.jinja2", datatable=datatable)

    return render_template("organization_list.jinja2", datatable=datatable)


@organization.route("/organizations/<int:id>", methods=["GET"])
def organization_show(id):
    org = Organization.query.get_or_404(id)
    return render_template("organization_show.jinja", organization=org)


def slugify(name: str) -> str:
    return slug.slug(name)


@organization.route("/organizations/add", methods=["GET", "POST"])
@login_required
def organization_add():
    form = OrganizationForm(request.form)
    set_form_choices(
        form,
        {
            "parent_id": generate_choices_from_list(
                Organization.query.order_by('name')
            )
        },
    )

    if request.method == "POST":
        if Organization.query.filter(
            and_(
                Organization.name == form.name.data,
                Organization.parent_id is None,
            )
        ).first():
            flash("An organization with that name already exists!")
            return render_template("organization_manage.jinja2", form=form)

        if form.validate():
            new_organization = Organization(
                name=form.name.data,
                short_name=form.short_name.data,
                description=form.description.data,
                slug=form.slug.data,
                parent_id=(None if form.parent.data == 0 else form.parent.data),
                address_id=form.address_id.data,
            )
            new_organization.create()

            flash("Organization created successfully.", "success")
            return redirect(url_for("organization.organization_list"))

    return render_template("organization_manage.jinja2", form=form)


@organization.route("/organizations/<int:id>/manage", methods=["GET", "POST"])
def organization_manage(id):
    org = Organization.query.get_or_404(id)
    form = OrganizationForm(obj=org)
    set_form_choices(
        form,
        {"parent_id": generate_choices_from_list(Organization.query.order_by("name"))},
    )

    if form.validate_on_submit():
        org.name = form.name.data
        org.abbreviation = form.abbreviation.data
        org.description = form.description.data
        org.slug = form.slug.data
        org.parent_id = form.parent.data
        org.address_id = form.address_id.data

        org.save()

        flash("Organization updated successfully.", "success")
        return redirect(url_for("organization.organization_show", id=org.id))
    return render_template("organization_manage.jinja2", form=form, organization=org)


@organization.route("/organizations/<int:id>/delete", methods=["GET", "POST"])
def organization_delete(id):
    """
    Render the organization delete page.

    This function renders the organization delete page, which displays a form for confirming the
    deletion of an organization. If the form is submitted, the organization is deleted from the
    database.

    Args:
        id (int): The ID of the organization to delete.

    Returns:
        rendered_template: The rendered HTML template for the organization delete page.
    """
    form = DeleteConfirmationForm(request.form)
    form.id = id

    if request.method == "POST" and form.validate():
        if form.confirm.data:
            # Remove all child organizations, factions, attendees, enrollments, and events
            org = Organization.query.get_or_404(id)
            org.delete()

            flash("Organization deleted successfully.", "success")
        else:
            flash("Organization deletion cancelled.")
        return redirect(url_for("organization.organization_list"))
    return render_template("delete.jinja2", form=form)
