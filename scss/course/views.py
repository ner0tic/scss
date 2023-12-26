""" This module defines the routes for the course blueprint. """
from flask import request, render_template, redirect, url_for, flash
from flask_login import login_required
from ..database import DataTable
from ..utils.utils import set_form_choices, gettext
from ..utils.forms import DeleteConfirmationForm
from .models import Course, Requirement
from .forms import CourseForm, RequirementForm
from ..course import course

###################################################################################################
# Course Related Routes ###########################################################################
###################################################################################################
@course.route("/courses/", methods=["GET"], strict_slashes=False)
def course_list():
    """
    Render the course list page.

    This function renders the course list page, which displays a table of course.
    The table is generated using the DataTable class, which provides sorting, searching,
    filtering, and pagination functionality. The table columns include the course's
    description, name, short name, organization ID, and creation date.

    Returns:
       rendered_template: The rendered HTML template for the course list page.
    """

    datatable = DataTable(
        model=Course,
        columns=[],
        sortable=[
            Course.name,
            Course.requirements,
            Course.course_type,
            Course.created_at,
        ],
        searchable=[Course.name],
        filterable=[Course.course_type],
        limits=[25, 50, 100],
        request=request,
    )

    #    if g.pjax:
    #       return render_template("courses.jinja2", datatable=datatable)

    return render_template(
        "course_list.jinja2",
        datatable=datatable,
        title=gettext("Course"),
    )

@course.route("/courses/<int:id>", methods=["GET"], strict_slashes=False)
def course_show(id):
    """Renders a template to edit a specific course.
    Args:
        course_id: The ID of the course to edit.
    Returns:
        The rendered template for editing the course.
    """

    crs = Course.query.get_or_404(id)
    return render_template("course_show.jinja2", course=crs)

@course.route("/courses/add", methods=["GET", "POST"])
@login_required
def course_add():
    """Renders a template to add a new course.
    Returns:
        The rendered template for adding a new course.
    """
    form = CourseForm(request.form)
    set_form_choices(form, {"course_type": ['Online', 'In-Person', 'merit-badge', 'other']})

    if request.method == "POST":
        if form.validate():
            crs = Course.create(
                name=form.data["name"],
                description=form.data["description"],
                avatar_url=form.data["avatar_url"],
                course_type=form.data["course_type"]
            )
            flash("Course added successfully!")
            return render_template("course_show.jinja2", course=crs)
        else:
            msg = ""
            for field, errors in form.errors.items():
                for error in errors:
                    msg += f"Error in field '{field}': {error}\n"
            flash(msg)
    return render_template("course_manage.jinja2", form=form)

@course.route("/courses/<int:id>/manage", methods=["GET", "POST"])
@login_required
def course_manage(id):
    """Edit the details of a course.

    Args:
        id: The ID of the course to edit.

    Returns:
        The rendered template for editing the course details.
    """

    crs = Course.query.get_or_404(id)
    form = CourseForm(obj=crs)
    set_form_choices(form, {"course_type": ['Online', 'In-Person', 'merit-badge', 'other']})

    if form.validate_on_submit():
        crs.name = form.name.data
        crs.description = form.description.data
        crs.avatar_url = form.avatar_url.data
        crs.course_type = form.course_type.data
        crs.save()

        flash("Course updated successfully!")
        return render_template("course_show.jinja2", course=crs)

    return render_template("course_manage.jinja2", form=form, course=crs)

@course.route("/courses/<int:id>/delete", methods=["GET", "POST"])
def course_delete(id):
    """
    Delete a course.

    Args:
        id: The ID of the course to delete.

    Returns:
        Union[Response, str]: A redirect response or a rendered template.
    """
    form = DeleteConfirmationForm(request.form)
    form.id = id

    if request.method == "POST" and form.validate():
        if form.confirm.data:
            # Remove all child organizations, courses, crsulty, enrollments, and events
            crs = Course.query.get_or_404(id)
            crs.delete()

            flash("Course deleted successfully.", "success")
        else:
            flash("Course deletion cancelled.")
        return redirect(url_for("course.course_list"))
    return render_template("delete.jinja2", form=form)

###################################################################################################
# Requirement Related Routes ######################################################################
###################################################################################################
@course.route("/courses/<int:id>/requirements", methods=["GET"], strict_slashes=False)
def requirement_list(id):
    """
    Render the requirement list page.

    This function renders the requirement list page, which displays a table of requirement.
    The table is generated using the DataTable class, which provides sorting, searching,
    filtering, and pagination functionality. The table columns include the requirement's
    description, name, short name, organization ID, and creation date.

    Returns:
       rendered_template: The rendered HTML template for the requirement list page.
    """

    datatable = DataTable(
        model=Requirement,
        columns=[],
        sortable=[
            Requirement.name,
            Requirement.description,
            Requirement.parent_id,
            Requirement.children,
            Requirement.created_at,
        ],
        searchable=[Requirement.name],
        filterable=[Requirement.parent_id],
        limits=[25, 50, 100],
        request=request,
    )

    #    if g.pjax:
    #       return render_template("requirements.jinja2", datatable=datatable)

    return render_template(
        "requirement_list.jinja2",
        datatable=datatable,
        title=gettext("Requirement"),
    )
    
@course.route("/courses/<int:id>/requirements/<int:rid>", methods=["GET"], strict_slashes=False)    
def requirement_show(id, rid):
    """Renders a template to edit a specific requirement.
    Args:
        requirement_id: The ID of the requirement to edit.
    Returns:
        The rendered template for editing the requirement.
    """

    req = Requirement.query.get_or_404(rid)
    return render_template("requirement_show.jinja2", requirement=req)

@course.route("/courses/<int:id>/requirements/add", methods=["GET", "POST"])
@login_required
def requirement_add(id):
    """Renders a template to add a new requirement.
    Returns:
        The rendered template for adding a new requirement.
    """
    form = RequirementForm(request.form)
    set_form_choices(form, {"parent_id": Requirement.query.all()})

    if request.method == "POST":
        if form.validate():
            req = Requirement.create(
                name=form.data["name"],
                description=form.data["description"],
                parent_id=form.data["parent_id"],
                course_id=id
            )
            flash("Requirement added successfully!")
            return render_template("requirement_show.jinja2", requirement=req)
        else:
            msg = ""
            for field, errors in form.errors.items():
                for error in errors:
                    msg += f"Error in field '{field}': {error}\n"
            flash(msg)
    return render_template("requirement_manage.jinja2", form=form)

@course.route("/courses/<int:id>/requirements/<int:rid>/manage", methods=["GET", "POST"])
@login_required
def requirement_manage(id, rid):
    """Edit the details of a requirement.

    Args:
        id: The ID of the requirement to edit.

    Returns:
        The rendered template for editing the requirement details.
    """

    req = Requirement.query.get_or_404(rid)
    form = RequirementForm(obj=req)
    set_form_choices(form, {"parent_id": Requirement.query.all()})

    if form.validate_on_submit():
        req.name = form.name.data
        req.description = form.description.data
        req.parent_id = form.parent_id.data
        req.save()

        flash("Requirement updated successfully!")
        return render_template("requirement_show.jinja2", requirement=req)

    return render_template("requirement_manage.jinja2", form=form, requirement=req)

@course.route("/courses/<int:id>/requirements/<int:rid>/delete", methods=["GET", "POST"])
def requirement_delete(id, rid):
    """
    Delete a requirement.

    Args:
        id: The ID of the requirement to delete.

    Returns:
        Union[Response, str]: A redirect response or a rendered template.
    """
    form = DeleteConfirmationForm(request.form)
    form.id = rid

    if request.method == "POST" and form.validate():
        if form.confirm.data:
            req = Requirement.query.get_or_404(rid)
            req.delete()

            flash("Requirement deleted successfully.", "success")
        else:
            flash("Requirement deletion cancelled.")
        return redirect(url_for("course.requirement_list", id=id))
    return render_template("delete.jinja2", form=form)
