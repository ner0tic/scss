""" Address Related Views. """
from flask import request, render_template, redirect, url_for, flash
from flask_login import login_required

from ..database import DataTable
from ..utils.forms import DeleteConfirmationForm, set_form_choices, generate_choices_from_list

from ..address import bp as addy_bp
from .models import Address
from .forms import AddressForm

@addy_bp.route("/addresses", methods=["GET"], strict_slashes=False)
def address_list():
    """
    Render the address list page.

    This function renders the address list page, which displays a table of addresss. The
    table is generated using the DataTable class, which provides sorting, searching, filtering, and
    pagination functionality. The table columns include the address's description, name, short
    name, parent ID, and creation date.

    Returns:
        rendered_template: The rendered HTML template for the address list page.
    """
    datatable = DataTable(
        model=Address,
        columns=["Name", "line1", "line2", "city", "state", "country", "postal_code"],
        sortable=[
            Address.name,
            Address.line1,
            Address.line2,
            Address.city,
            Address.state,
            Address. country,
            Address.postal_code
        ],
        searchable=[],
        filterable=[],  # address.active],
        limits=[25, 50, 100],
        request=request,
    )

    return render_template("list.jinja2", datatable=datatable)


@addy_bp.route("/addresses/<int:id>", methods=["GET"])
def address_show(id):
    """
    Renders the address show page.

    Args:
        id (int): The ID of the address.

    Returns:
        str: The rendered HTML template for the address show page.

    """
    addy = Address.query.get_or_404(id)

    return render_template("show.jinja", address=addy)


@addy_bp.route("/addresses/add", methods=["GET", "POST"])
@login_required
def address_add():
    form = AddressForm(request.form)
    set_form_choices(
        form,
        {
            "parent_id": generate_choices_from_list(
                Address.query.order_by('country')
            )
        },
    )

    if request.method == "POST" and form.validate():
        new_address = Address(
            name=form.name.data,
            line1=form.line1.data,
            line2=form.line2.data,
            city=form.city.data,
            state=form.state.data,
            country=form.country.data,
            postal_code=form.postal_code.data
        )
        new_address.create()

        flash("Address created successfully.", "success")
        return redirect(url_for("address.address_list"))

    return render_template("manage.jinja2", form=form)


@addy_bp.route("/addresses/<int:id>/manage", methods=["GET", "POST"])
def address_manage(id):
    """
    Renders the address management page.

    Args:
        id (int): The ID of the address.

    Returns:
        str: The rendered HTML template for the address management page.
    """
    addy = Address.query.get_or_404(id)
    form = AddressForm(obj=addy)
    set_form_choices(
        form,
        {"parent_id": generate_choices_from_list(Address.query.order_by("state"))},
    )

    if form.validate_on_submit():
        addy.name = form.name.data
        addy.line1 = form.line1.data
        addy.line2 = form.line2.data
        addy.city = form.city.data
        addy.state = form.state.data
        addy.state = form.state.data
        addy.country = form.country.data
        addy.postal_code = form.postal_code.data

        addy.save()

        flash("address updated successfully.", "success")
        return redirect(url_for("address.address_show", id=addy.id))
    return render_template("manage.jinja2", form=form, address=addy)


@addy_bp.route("/addresses/<int:id>/delete", methods=["GET", "POST"])
def address_delete(id):
    """
    Render the address delete page.

    This function renders the address delete page, which displays a form for confirming the
    deletion of an address. If the form is submitted, the address is deleted from the
    database.

    Args:
        id (int): The ID of the address to delete.

    Returns:
        rendered_template: The rendered HTML template for the address delete page.
    """
    form = DeleteConfirmationForm(request.form)
    form.id = id

    if request.method == "POST" and form.validate():
        if form.confirm.data:
            addy = Address.query.get_or_404(id)
            addy.delete()

            flash("Address deleted successfully.", "success")
        else:
            flash("Address deletion cancelled.")
        return redirect(url_for("address.address_list"))
    return render_template("delete.jinja2", form=form)
