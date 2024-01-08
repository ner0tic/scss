""" Admin models """
from flask_login import current_user
from flask_admin.contrib.sqla import ModelView
from flask_admin.menu import MenuLink
from flask_principal import Permission, RoleNeed
from wtforms.fields import PasswordField
from flask import redirect, url_for, request

class BaseModelView(ModelView):
    admin_permission = Permission(RoleNeed("admin"))

    # Fields to be displayed in the form
    #form_columns = ["username", "email", "role"]

    # Custom formatting for specific columns
    column_formatters = {
        "created_at": lambda v, c, m, p: m.created_at.strftime("%Y-%m-%d %H:%M")
        if m.created_at
        else ""
    }

    # Overriding form fields
    form_overrides = {"password": PasswordField}

    # Fields to exclude from the list view
    column_exclude_list = ["password", "password_hash"]

    # Check if user is authenticated and has admin role
    def is_accessible(self):
        return current_user.is_authenticated and self.admin_permission.can()

    # Redirect to login page if user is not authorized
    def inaccessible_callback(self, name, **kwargs):
        if not current_user.is_authenticated:
            return redirect(url_for("auth.login", next=request.url))
        return redirect(url_for("utils_bp.home"))
