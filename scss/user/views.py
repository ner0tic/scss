""" User views. """
from flask import request, redirect, url_for, render_template, flash, g
# from flask_babel import gettext
from flask_login import login_required

from ..utils.utils import gettext
from ..database import DataTable
from ..user import bp as user_bp

from .models import User
from .forms import EditUserForm


@user_bp.route('/list', methods=['GET', 'POST'])
@login_required
def user_list():
    """
    Render the user list page.

    This function renders the user list page, which displays a table of users. The table is generated using the DataTable class, which provides sorting, searching, filtering, and pagination functionality. The table columns include the user's remote address, username, email, and creation date.

    Returns:
        rendered_template: The rendered HTML template for the user list page.
    """

    datatable = DataTable(
        model=User,
        columns=[User.remote_addr],
        sortable=[User.username, User.email, User.created_at],
        searchable=[User.username, User.email],
        filterable=[User.active],
        limits=[25, 50, 100],
        request=request
    )

    if g.pjax:
        return render_template('users.html', datatable=datatable)

    return render_template('list.html', datatable=datatable)

@user_bp.route('/edit/<int:id>', methods=['GET', 'POST'])
@login_required
def edit(id):
    """
    Edit a user.

    This function handles the editing of a user based on the provided user ID. It retrieves the user from the database, populates an EditUserForm with the user's data, and renders the edit template. If the form is submitted and passes validation, the user's data is updated and saved to the database. Finally, a success message is flashed and the edit template is rendered.

    Args:
        id: The ID of the user to edit.

    Returns:
        rendered_template: The rendered HTML template for editing the user.
    """

    usr = User.query.filter_by(id=id).first_or_404()
    form = EditUserForm(obj=usr)
    if form.validate_on_submit():
        form.populate_obj(usr)
        usr.update()
        flash(gettext(f'User {usr.username} edited'), 'success')

    return render_template('edit.html', form=form, user=usr)


@user_bp.route('/delete/<int:id>', methods=['GET'])
@login_required
def delete(id):
    """
    Delete a user.

    This function handles the deletion of a user based on the provided user ID. It retrieves the user from the database, deletes it, and flashes a success message. Finally, it redirects to the user list page.

    Args:
        id: The ID of the user to delete.

    Returns:
        redirect: A redirect response to the user list page.
    """

    usr = User.query.filter_by(id=id).first_or_404()
    usr.delete()
    flash(gettext(f'User {usr.username} deleted'), 'success')

    return redirect(url_for('.list'))
