from flask_admin.contrib.sqla import ModelView
from flask import current_app as app
from ..database import db
from ..organization.models.organization import Organization

#admin = app.admin
#admin.add_view(ModelView(Organization, db))
