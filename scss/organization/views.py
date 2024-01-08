""" This module contains the views for the organization blueprint."""
from flask import request, render_template, redirect, url_for, flash
from flask_login import login_required
from sqlalchemy import and_

from ..database import DataTable
from ..utils.forms import DeleteConfirmationForm, set_form_choices, generate_choices_from_list

from ..organization import bp as org_bp
from .models.organization import Organization
from .forms import OrganizationForm

@org_bp.route("/organizations", methods=["GET"], strict_slashes=False)
def organization_list():
    """
    Render the organization list page.

    This function renders the organization list page, which displays a table of organizations. The
    table is generated using the DataTable class, which provides sorting, searching, filtering, and
    pagination functionality. The table columns include the organization's description, name, short
    name, parent ID, and creation date.

    Returns:
        rendered_template: The rendered HTML template for the organization list page.
    """
    datatable = DataTable(
        model=Organization,
        columns=["Name", "Abbreviation", "Description", "Parent", "Created On"],
        sortable=[
            Organization.name,
            Organization.abbreviation,
            Organization.description,
            Organization.parent,
            Organization.created_on,
        ],
        searchable=[Organization.name, Organization.abbreviation],
        filterable=[],  # Organization.active],
        limits=[25, 50, 100],
        request=request,
    )

    return render_template("organization_list.jinja2", datatable=datatable)


@org_bp.route("/organizations/<int:id>", methods=["GET"])
def organization_show(id):
    """
    Renders the organization show page.

    Args:
        id (int): The ID of the organization.

    Returns:
        str: The rendered HTML template for the organization show page.

    """
    org = Organization.query.get_or_404(id)

    return render_template("organization_show.jinja", organization=org)


@org_bp.route("/organizations/add", methods=["GET", "POST"])
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


@org_bp.route("/organizations/<int:id>/manage", methods=["GET", "POST"])
def organization_manage(id):
    """
    Renders the organization management page.

    Args:
        id (int): The ID of the organization.

    Returns:
        str: The rendered HTML template for the organization management page.
    """
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


@org_bp.route("/organizations/<int:id>/delete", methods=["GET", "POST"])
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
            org = Organization.query.get_or_404(id)
            org.delete()

            flash("Organization deleted successfully.", "success")
        else:
            flash("Organization deletion cancelled.")
        return redirect(url_for("organization.organization_list"))
    return render_template("delete.jinja2", form=form)
