""" This module contains the routes for the facility blueprint. """
from flask import request, render_template, redirect, url_for, flash
from flask_login import login_required
from ..database import DataTable
from ..utils.utils import set_form_choices, gettext
from ..utils.forms import DeleteConfirmationForm
from ..utils.models import Address
from ..utils.debug import debug_form
from ..organization.models import Organization
from .forms import FacilityForm, FacultyForm, DepartmentForm, QuartersForm
from .models import Facility, Faculty, Department, Quarters
from ..facility import facility

###################################################################################################
# Facility Related Routes #########################################################################
###################################################################################################
@facility.route("/facilities/", methods=["GET"], strict_slashes=False)
def facility_list():
    """
    Render the facility list page.

    This function renders the facility list page, which displays a table of facility.
    The table is generated using the DataTable class, which provides sorting, searching,
    filtering, and pagination functionality. The table columns include the facility's
    description, name, short name, organization ID, and creation date.

    Returns:
       rendered_template: The rendered HTML template for the facility list page.
    """

    datatable = DataTable(
        model=Facility,
        columns=[],
        sortable=[
            Facility.name,
            Facility.organization_id,
            Facility.created_at,
        ],
        searchable=[Facility.name],
        filterable=[Facility.organization_id],
        limits=[25, 50, 100],
        request=request,
    )

    #    if g.pjax:
    #       return render_template("facilities.jinja2", datatable=datatable)

    return render_template(
        "facility_list.jinja2",
        datatable=datatable,
        title=gettext("Facility"),
    )

@facility.route("/facilities/<int:id>", methods=["GET"], strict_slashes=False)
def facility_show(id):
    """Renders a template to edit a specific facility.
    Args:
        facility_id: The ID of the facility to edit.
    Returns:
        The rendered template for editing the facility.
    """

    fac = Facility.query.get_or_404(id)
    return render_template("facility_show.jinja2", facility=fac)

@facility.route("/facilities/add", methods=["GET", "POST"])
@login_required
def facility_add():
    """Renders a template to add a new facility.
    Returns:
        The rendered template for adding a new facility.
    """
    form = FacilityForm(request.form)
    set_form_choices(form, {"organization_id": Organization.query.order_by("name")})

    debug_form(form, label="before request check")

    if request.method == "POST":
        debug_form(form, label="before validation check")
        if form.validate():
            debug_form(form, label="after validation check")
            addr = Address.create(
                line1=form.data["address_id"]["line1"],
                line2=form.data["address_id"]["line2"],
                city=form.data["address_id"]["city"],
                state=form.data["address_id"]["state"],
                postal_code=form.data["address_id"]["postal_code"],
                country=form.data["address_id"]["country"],
            )
            debug_form(form, label="after address obj creation")
            fac = Facility.create(
                name=form.data["name"],
                description=form.data["description"],
                avatar=form.data["avatar"],
                organization_id=form.data["organization_id"],
                address_id=addr.id,
            )
            debug_form(form, label="after facility object creation")
            flash("Facility added successfully!")
            return render_template("facility_show.jinja2", facility=fac)
        else:
            msg = ""
            for field, errors in form.errors.items():
                for error in errors:
                    msg += f"Error in field '{field}': {error}\n"
            flash(msg)
    return render_template("facility_manage.jinja2", form=form)

@facility.route("/facilities/<int:id>/manage", methods=["GET", "POST"])
@login_required
def facility_manage(id):
    """Edit the details of a facility.

    Args:
        id: The ID of the facility to edit.

    Returns:
        The rendered template for editing the facility details.
    """

    fac = Facility.query.get_or_404(id)
    form = FacilityForm(obj=fac)
    set_form_choices(form, {"organization_id": Organization.query.order_by("name")})

    if form.validate_on_submit():
        fac.name = form.name.data
        fac.description = form.description.data
        fac.avatar = form.avatar.data
        fac.organization_id = form.organization.data
        fac.save()

        flash("Facility updated successfully!")
        return render_template("facility_show.jinja2", facility=fac)

    return render_template("facility_manage.jinja2", form=form, facility=fac)

@facility.route("/facilities/<int:id>/delete", methods=["GET", "POST"])
def facility_delete(id):
    """
    Delete a facility.

    Args:
        id: The ID of the facility to delete.

    Returns:
        Union[Response, str]: A redirect response or a rendered template.
    """
    form = DeleteConfirmationForm(request.form)
    form.id = id

    if request.method == "POST" and form.validate():
        if form.confirm.data:
            # Remove all child organizations, facilities, faculty, enrollments, and events
            fac = Facility.query.get_or_404(id)
            fac.delete()

            flash("Facility deleted successfully.", "success")
        else:
            flash("Facility deletion cancelled.")
        return redirect(url_for("facility.facility_list"))
    return render_template("delete.jinja2", form=form)

###################################################################################################
# Faculty Related Routes ##########################################################################
###################################################################################################
@facility.route("/faculty", methods=["GET"], strict_slashes=False)
def faculty_list():
    """Renders a template to display a list of faculty.
    Returns:
        The rendered template for displaying the list of faculty.
    Raises:
        None.
    """

    datatable = DataTable(
        model=Faculty,
        columns=[],
        sortable=[
            Faculty.first_name,
            Faculty.last_name,
            Faculty.facility_id,
            Faculty.department_id,
            Faculty.created_at,
        ],
        searchable=[Faculty.last_name, Faculty.first_name],
        filterable=[Faculty.facility_id, Faculty.department_id],
        limits=[25, 50, 100],
        request=request,
    )

    #    if g.pjax:
    #        return render_template("faculty.jinja2l", datatable=datatable)

    return render_template("faculty_list.jinja2", datatable=datatable)

@facility.route("/faculty/<int:id>", methods=["GET"], strict_slashes=False)
def faculty_show(id):
    """Renders a template to display the details of a specific faculty.
    Args:
        id: The ID of the faculty to display.

    Returns:
        The rendered template for displaying the faculty details.
    """
    fac = Faculty.query.get_or_404(id)
    return render_template("faculty_show.jinja2", faculty=fac)

@facility.route("/faculty/add", methods=["GET", "POST"])
@login_required
def faculty_add():
    """Renders a template to add a new faculty.
    Returns:
        The rendered template for adding a new faculty.
    """
    form = FacultyForm(request.form)
    set_form_choices(form, {
        'department_id': Department.query.order_by('name'),
        'facility_id': Facility.query.order_by('name')
    })

    if request.method == "POST":
        if form.validate():
            addr = Address.create(
                line1=form.data["address_id"]["line1"],
                line2=form.data["address_id"]["line2"],
                city=form.data["address_id"]["city"],
                state=form.data["address_id"]["state"],
                postal_code=form.data["address_id"]["postal_code"],
                country=form.data["address_id"]["country"],
            )

            fac = Faculty.create(
                first_name=form.first_name.data,
                last_name=form.last_name.data,
                username=form.username.data,
                email=form.email.data,
                password=form.password.data,
                role="faculty",
                address_id=addr.id,
                avatar_url=form.avatar_url.data,
                department_id=form.department_id.data,
                facility_id=form.facility_id.data,
            )

            flash("Faculty added successfully!")
            return render_template("faculty_show.jinja2", faculty=fac)
        else:
            for field, errors in form.errors.items():
                for error in errors:
                    flash(f"Error in field '{field}': {error}")
    return render_template("faculty_manage.jinja2", form=form)

@facility.route(
    "/faculty/<int:id>/manage", methods=["GET", "POST"], strict_slashes=False
)
@login_required
def faculty_manage(id):
    """Edit the details of an faculty.

    Args:
        id: The ID of the faculty to edit.

    Returns:
        The rendered template for editing the faculty details.

    """

    fac = Faculty.get_or_404(id)
    form = FacultyForm(obj=fac)
    set_form_choices(form, {
        'department_id': Department.query.order_by('name'),
        'facility_id': Facility.query.order_by('name')
    })

    if form.validate_on_submit():
        fac.first_name = form.first_name.data
        fac.last_name = form.last_name.data
        fac.username = form.username.data
        fac.role = "faculty"
        fac.avatar_url = form.avatar_url.data
        fac.department_id = form.department_id.data
        fac.facility_id = form.facility_id.data
        fac.save()

        flash("Faculty updated successfully!")
        return render_template("faculty_show.jinja2", faculty=fac)

    return render_template("faculty_manage.jinja2", form=form, faculty=fac)

@facility.route("/faculty/<int:id>/delete", methods=["GET", "POST"])
def faculty_delete(id):
    form = DeleteConfirmationForm(request.form)
    form.id = id

    if request.method == "POST" and form.validate():
        if form.confirm.data:
            fac = Faculty.query.get_or_404(id)
            fac.delete()

            flash("Faculty deleted successfully.", "success")
        else:
            flash("Faculty deletion cancelled.")
        return redirect(url_for("facility.faculty_list"))
    return render_template("delete.jinja2", form=form)

###################################################################################################
# Department Related Routes #######################################################################
###################################################################################################
@facility.route("/departments", methods=["GET"], strict_slashes=False)
def department_list():
    """Renders a template to display a list of department.
    Returns:
        The rendered template for displaying the list of department.
    Raises:
        None.
    """

    datatable = DataTable(
        model=Department,
        columns=[],
        sortable=[
            Department.name,
            Department.facility_id,
            Department.created_at,
        ],
        searchable=[Department.name],
        filterable=[Department.facility_id],
        limits=[25, 50, 100],
        request=request,
    )

    #    if g.pjax:
    #        return render_template("departments.jinja2l", datatable=datatable)

    return render_template("department_list.jinja2", datatable=datatable)

@facility.route("/departments/<int:id>", methods=["GET"], strict_slashes=False)
def department_show(id):
    """Renders a template to display the details of a specific department.
    Args:
        id: The ID of the department to display.

    Returns:
        The rendered template for displaying the department details.
    """
    dept = Department.query.get_or_404(id)
    return render_template("department_show.jinja2", department=dept)

@facility.route("/departments/add", methods=["GET", "POST"])
@login_required
def department_add():
    """Renders a template to add a new department.
    Returns:
        The rendered template for adding a new department.
    """
    form = DepartmentForm(request.form)
    set_form_choices(form, {
        'parent_id': Department.query.order_by('name'),
        'facility_id': Facility.query.order_by('name')
    })

    if request.method == "POST":
        if form.validate():
            dept = Department.create(
                name=form.first_name.data,
                description=form.last_name.data,
                avatar=form.avatar.data,
                parent_id=form.parent_id.data,
                facility_id=form.facility_id.data,
            )

            flash("Department added successfully!")
            return render_template("department_show.jinja2", department=dept)
        else:
            for field, errors in form.errors.items():
                for error in errors:
                    flash(f"Error in field '{field}': {error}")
    return render_template("department_manage.jinja2", form=form)

@facility.route(
    "/departments/<int:id>/manage", methods=["GET", "POST"], strict_slashes=False
)
@login_required
def department_manage(id):
    """Edit the details of an department.

    Args:
        id: The ID of the department to edit.

    Returns:
        The rendered template for editing the department details.

    """

    dept = Department.get_or_404(id)
    form = DepartmentForm(obj=dept)
    set_form_choices(form, {
        'parent_id': Department.query.order_by('name'),
        'facility_id': Facility.query.order_by('name')
    })

    if form.validate_on_submit():
        dept.name = form.name.data
        dept.description = form.description.data
        dept.avatar = form.avatar.data
        dept.parent_id = form.parent_id.data
        dept.facility_id = form.facility_id.data
        dept.save()

        flash("Department updated successfully!")
        return render_template("department_show.jinja2", department=dept)

    return render_template("department_manage.jinja2", form=form, department=dept)

@facility.route("/departments/<int:id>/delete", methods=["GET", "POST"])
def department_delete(id):
    form = DeleteConfirmationForm(request.form)
    form.id = id

    if request.method == "POST" and form.validate():
        if form.confirm.data:
            dept = Department.query.get_or_404(id)
            dept.delete()

            flash("Department deleted successfully.", "success")
        else:
            flash("Department deletion cancelled.")
        return redirect(url_for("facility.department_list"))
    return render_template("delete.jinja2", form=form)

###################################################################################################
# Quarters Related Routes #########################################################################
###################################################################################################
@facility.route("/quarters", methods=["GET"], strict_slashes=False)
def quarters_list():
    """Renders a template to display a list of quarters.
    Returns:
        The rendered template for displaying the list of quarters.
    Raises:
        None.
    """

    datatable = DataTable(
        model=Quarters,
        columns=[],
        sortable=[
            Quarters.name,
            Quarters.quarters_type,
            Quarters.facility_id,
            Quarters.created_at,
        ],
        searchable=[Quarters.name],
        filterable=[Quarters.facility_id, Quarters.quarters_type],
        limits=[25, 50, 100],
        request=request,
    )

    #    if g.pjax:
    #        return render_template("quarters.jinja2l", datatable=datatable)

    return render_template("quarters_list.jinja2", datatable=datatable)

@facility.route("/quarters/<int:id>", methods=["GET"], strict_slashes=False)
def quarters_show(id):
    """Renders a template to display the details of a specific quarters.
    Args:
        id: The ID of the quarters to display.

    Returns:
        The rendered template for displaying the quarters details.
    """
    qtr = Quarters.query.get_or_404(id)
    return render_template("quarters_show.jinja2", quarters=qtr)

@facility.route("/quarters/add", methods=["GET", "POST"])
@login_required
def quarters_add():
    """Renders a template to add a new quarters.
    Returns:
        The rendered template for adding a new quarters.
    """
    form = QuartersForm(request.form)
    set_form_choices(
        form,
        {
            "quarters_type": [
                (Quarters.FACTION_QUARTERS, "Faction Quarters"),
                (Quarters.LEADER_QUARTERS, "Leader Quarters"),
                (Quarters.ATTENDEE_QUARTERS, "Attendee Quarters"),
                (Quarters.FACULTY_QUARTERS, "Faculty Quarters"),
                (Quarters.OTHER_QUARTERS, "Other Quarters"),
            ],
            "facility_id": Facility.query.order_by("name"),
        },
    )

    if request.method == "POST":
        if form.validate():
            qtr = Quarters.create(
                name=form.first_name.data,
                description=form.last_name.data,
                avatar=form.avatar.data,
                quarters_type=form.quarters_type.data,
                facility_id=form.facility_id.data,
            )

            flash("Quarters added successfully!")
            return render_template("quarters_show.jinja2", quarters=qtr)
        else:
            for field, errors in form.errors.items():
                for error in errors:
                    flash(f"Error in field '{field}': {error}")
    return render_template("quarters_manage.jinja2", form=form)

@facility.route(
    "/quarters/<int:id>/manage", methods=["GET", "POST"], strict_slashes=False
)
@login_required
def quarters_manage(id):
    """Edit the details of an quarters.

    Args:
        id: The ID of the quarters to edit.

    Returns:
        The rendered template for editing the quarters details.

    """

    qtr = Quarters.get_or_404(id)
    form = QuartersForm(obj=qtr)
    set_form_choices(
        form,
        {
            "quarters_type": [
                (Quarters.FACTION_QUARTERS, "Faction Quarters"),
                (Quarters.LEADER_QUARTERS, "Leader Quarters"),
                (Quarters.ATTENDEE_QUARTERS, "Attendee Quarters"),
                (Quarters.FACULTY_QUARTERS, "Faculty Quarters"),
                (Quarters.OTHER_QUARTERS, "Other Quarters"),
            ],
            "facility_id": Facility.query.order_by("name"),
        },
    )

    if form.validate_on_submit():
        qtr.name = form.name.data
        qtr.description = form.description.data
        qtr.avatar = form.avatar.data
        qtr.quarters_type = form.quarters_type.data
        qtr.facility_id = form.facility_id.data
        qtr.save()

        flash("Quarters updated successfully!")
        return render_template("quarters_show.jinja2", quarters=qtr)

    return render_template("quarters_manage.jinja2", form=form, quarters=qtr)

@facility.route("/quarters/<int:id>/delete", methods=["GET", "POST"])
def quarters_delete(id):
    form = DeleteConfirmationForm(request.form)
    form.id = id

    if request.method == "POST" and form.validate():
        if form.confirm.data:
            qtr = Quarters.query.get_or_404(id)
            qtr.delete()

            flash("Quarters deleted successfully.", "success")
        else:
            flash("Quarters deletion cancelled.")
        return redirect(url_for("facility.quarters_list"))
    return render_template("delete.jinja2", form=form)
