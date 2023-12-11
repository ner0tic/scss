from flask import request, redirect, url_for, render_template, flash, g
from flask_babel import gettext
from flask_login import login_required
from .models import Course
from .forms import EditCourseForm

from scss.utils import generate_choices_from_list
from ..course import course

@course.route('/', methods=['GET'])
def list():
    from scss.database import DataTable
    datatable = DataTable(
        model=Course,
        columns=[Course.description],
        sortable=[Course.name, Course.course_type, Course.parent_id, Course.created_at],
        searchable=[Course.name],
        filterable=[Course.active],
        limits=[25, 50, 100],
        request=request
    )

    if g.pjax:
        return render_template('courses.jinja2l', datatable=datatable)

    return render_template('list.jinja2', datatable=datatable)