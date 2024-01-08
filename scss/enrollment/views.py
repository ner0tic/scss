""" Enrollment Views. """
from flask import request, render_template, flash

# from flask_babel import gettext
from flask_login import login_required


from ..utils.utils import gettext
from ..utils.forms import generate_choices_from_list
from ..database import DataTable
from ..enrollment import bp as en_bp

from ..organization.models.organization import Organization

from .forms import EditTemporalHierarchyForm
from .models.temporal_hierarchy import TemporalHierarchy


@en_bp.route("/list", methods=["GET", "POST"])
@login_required
def temporal_hierarchy_list():
    """Temporal Hierarchy List View."""

    datatable = DataTable(
        model=TemporalHierarchy,
        columns=[TemporalHierarchy.description],
        sortable=[
            TemporalHierarchy.name,
            TemporalHierarchy.abbreviation,
            TemporalHierarchy.created_at,
        ],
        searchable=[TemporalHierarchy.name, TemporalHierarchy.abbreviation],
        filterable=[],  # TemporalHierarchy.active],
        limits=[25, 50, 100],
        request=request,
    )

    #    if g.pjax:
    #        return render_template('temporal_hierarchies.jinja2', datatable=datatable)

    return render_template("list.jinja2", datatable=datatable)


@en_bp.route("/edit/<int:id>", methods=["GET", "POST"])
@login_required
def temporal_hierarchy_edit(id):
    """
    Function: temporal_hierarchy_edit

    Edit the temporal hierarchy with the given ID.

    Args:
        id: The ID of the temporal hierarchy to edit.

    Returns:
        The rendered template for editing the temporal hierarchy.
    """

    def set_form_choices(form):
        """Sets the choices for the organization parent and factions in a given form.
        Args:
            form: The form to set the choices for.
        Returns:
            None.
        """

        form.temporal_hierarchy_parent.choices = generate_choices_from_list(
            TemporalHierarchy.query.order_by("name")
        )
        form.organization.choices = generate_choices_from_list(
            Organization.query.order_by("name")
        )

    temporal_hierarchy = TemporalHierarchy.query.filter_by(id=id).first_or_404()
    form = EditTemporalHierarchyForm(obj=temporal_hierarchy)
    set_form_choices(form)

    if form.validate_on_submit():
        form.populate_obj(temporal_hierarchy)
        temporal_hierarchy.update()
        flash(
            gettext(f"Temporal Hierarchy {temporal_hierarchy.name} edited"), "success"
        )
    return render_template(
        "edit.jinja2", form=form, temporal_hierarchy=temporal_hierarchy
    )
