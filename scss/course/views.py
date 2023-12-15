from flask import request, redirect, url_for, render_template, flash, g
from flask_babel import gettext
from flask_login import login_required
from ..database import DataTable
from ..utils.utils import generate_choices_from_list
from .models import Course
from .forms import EditCourseForm
from ..course import course

@course.route('/', methods=['GET'])
def course_list():
    datatable = DataTable(
        model=Course,
        columns=[Course.description],
        sortable=[Course.name, Course.course_type, Course.created_at],
        searchable=[Course.name],
        filterable=[Course.course_type],
        limits=[25, 50, 100],
        request=request
    )

    if g.pjax:
        return render_template('courses.jinja2l', datatable=datatable)

    return render_template('list.jinja2', datatable=datatable)