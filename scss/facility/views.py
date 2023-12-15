from flask import request, redirect, url_for, render_template, flash
from flask_babel import gettext
from flask_login import login_required
from ..organization.models import Organization
from ..utils.utils import generate_choices_from_list
from ..utils.forms import DeleteConfirmationForm
from ..utils.models import Address
from ..facility.forms import FacilityAddForm, EditFacilityForm
from ..facility.models import Facility
from ..facility import facility


# Facility Related Routes
@facility.route("/facilities/", methods=["GET"], strict_slashes=False)
def facility_list():
    """Renders a template to display a list of facilities.
    Returns:
        The rendered template for displaying the list of facilities.
    """

    return render_template(
        "list.jinja2", facilities=Facility.query().all(), title="All Facilities"
    )


@facility.route("/facilities/<int:facility_id>", methods=["GET"], strict_slashes=False)
def facility_detail(facility_id):
    """Renders a template to edit a specific facility.
    Args:
        facility_id: The ID of the facility to edit.
    Returns:
        The rendered template for editing the facility.
    """

    return render_template(
        "facility/show.jinja2",
        facility=Facility.query().filter(Facility.id == facility_id).first(),
        title="Facility Details",
    )

@facility.route(
    "/facilities/<int:facility_id>/edit",
    methods=["GET", "POST"],
    strict_slashes=False,
)
def facility_edit(facility_id):
    """
    Edit a facility.

    This function handles the editing of a facility based on the provided facility ID. 
    It retrieves the facility from the database, populates an EditFacilityForm with the facility's data, 
    and renders the edit template. If the form is submitted and passes validation, the facility's data is updated
    and saved to the database. Finally, the function redirects to the facility's details page.

    Args:
        facility_id: The ID of the facility to edit.

    Returns:
        rendered_template: The rendered HTML template for editing the facility.
    """

    org = Facility.query().filter(Facility.id == facility_id).first()
    form = EditFacilityForm(obj=org)

    if request.method == "POST" and form.validate():
        org.name = form.name.data
        org.short_name = form.short_name.data
        org.description = form.description.data
        org.parent_id = form.parent_id.data
        org.factions = form.factions.data

        org.save()
        flash(gettext("Facility updated successfully!"), "success")
        return redirect(url_for("facility.facility_show", facility_id=org.id))

    return render_template("edit.jinja2", form=form, title="Edit Facility")


@facility.route(
    "/factions/<int:facility_id>/delete", methods=["GET"], strict_slashes=False
)
def facility_delete_get(facility_id):
    """Handles the GET request to display the delete confirmation page for a facility.
    Args:
        facility_id: The ID of the facility to delete.
    Returns:
        The rendered template for the delete confirmation page.

    """

    form = DeleteConfirmationForm(request.form)
    form.id = facility_id

    return render_template(
        "delete.jinja2",
        facility=Facility.query().filter(Facility.id == facility_id).first(),
        form=form,
        title="Delete Facility",
    )


@facility.route(
    "/facilities/<int:facility_id>/delete", methods=["POST"], strict_slashes=False
)
def facility_delete_post(facility_id):
    """Handles the POST request to delete a facility.
    Args:
        facility_id: The ID of the facility to delete.
    Returns:
        The rendered template for displaying the list of facilities after deletion.
    """

    form = DeleteConfirmationForm(request.form)
    form.id = facility_id
    if not form.validate() or not form.confirm.data:
        flash("Facility deletion cancelled!")
        # redirect(url_for("facility.facility_list"))
        return render_template(
            "list.jinja2", facilities=Facility.query().all(), title="All Facilities"
        )

    # Remove all child facilities, attendees, enrollments, and events
    # @todo: implement removal of all child-related objects
    # Remove Facility
    Facility.query().filter(Facility.id == facility_id).delete()

    flash("Facility deleted successfully!")
    return render_template(
        "list.jinja2", facilities=Facility.query().all(), title="All Facilities"
    )


@facility.route("/facilities/add", methods=["GET", "POST"], strict_slashes=False)
def facility_add():
    """
    Renders a template to add a new facility.

    Returns:
        The rendered template Renders a template for adding a to add a new facility.

    new facility.

    Raises:
        Returns:
        None.
    """

    fac = Facility()

    if request.method == "POST":
        form = FacilityAddForm(request.form)
        form.organization_id.choices = generate_choices_from_list(
            Organization.query().order_by("name")
        )
        # address_form = AddressAddForm(form.address_id.form)

        if form.validate():
            fac.name = form.name.data
            fac.description = form.description.data
            fac.avatar = form.avatar.data
            fac.organization_id = form.organization_id.data

            addy = Address(
                # name = form.address_id.name,
                line1=form.address_id.line1.data,
                line2=form.address_id.line2.data,
                city=form.address_id.city.data,
                state=form.address_id.state.data,
                postal_code=form.address_id.postal_code.data,
                country=form.address_id.country.data,
            )
            addy.save()

            fac.address_id = addy.id
            fac.save()

            flash("Facility added successfully!")
            return render_template("show.jinja2", facility=fac)
    else:
        form = FacilityAddForm(obj=facility)
        form.organization_id.choices = generate_choices_from_list(
            Organization.query().order_by("name")
        )
        form.address_id.label = "Address"

    return render_template("add.jinja2", form=form, title="Add Facility")
