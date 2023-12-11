from flask import request, redirect, url_for, render_template, flash, g
from flask_babel import gettext
from flask_login import login_required
from scss.enrollment.models import TemporalHierarchy
from scss.organization.models import Organization
from scss.utils import generate_choices_from_list
from .forms import EditTemporalHierarchyForm

from ..enrollment import enrollment


@enrollment.route('/list', methods=['GET', 'POST'])
@login_required
def temporal_hierarchy_list():
    from scss.database import DataTable
    datatable = DataTable(
        model=TemporalHierarchy,
        columns=[TemporalHierarchy.description],
        sortable=[TemporalHierarchy.name, TemporalHierarchy.short_name, TemporalHierarchy.created_at],
        searchable=[TemporalHierarchy.name, TemporalHierarchy.short_name],
        filterable=[], # TemporalHierarchy.active],
        limits=[25, 50, 100],
        request=request
    )

    if g.pjax:
        return render_template('temporal_hierarchies.jinja2', datatable=datatable)

    return render_template('list.jinja2', datatable=datatable)

@enrollment.route('/edit/<int:id>', methods=['GET', 'POST'])
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

        form.temporal_hierarchy_parent.choices = generate_choices_from_list(TemporalHierarchy.query().order_by('name'))
        form.organization.choices = generate_choices_from_list(Organization.query().order_by('name'))

    temporal_hierarchy = TemporalHierarchy.query.filter_by(id=id).first_or_404()
    form = EditTemporalHierarchyForm(obj=temporal_hierarchy)
    set_form_choices(form)
    
    if form.validate_on_submit():
        form.populate_obj(temporal_hierarchy)
        temporal_hierarchy.update()
        flash(gettext(f'Temporal Hierarchy {temporal_hierarchy.name} edited'), 'success')
    return render_template('edit.jinja2', form=form, temporal_hierarchy=temporal_hierarchy)

