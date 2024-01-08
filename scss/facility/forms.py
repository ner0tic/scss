""" Facility Forms """
from flask_wtf import FlaskForm
from wtforms import (
    StringField,
    SubmitField,
    SelectField,
    TextAreaField,
    FormField,
    HiddenField,
)
from wtforms.validators import InputRequired

from ..address.forms import AddressForm
from ..user.forms import UserForm

class FacilityForm(FlaskForm):
    """
    Class representing a Facility Form.

    This class represents a form for adding a new facility. It includes fields for the facility's name, description, avatar, address, organization, and factions. The form can be submitted to add the facility to the database.

    Attributes:
        name (StringField): The field for the facility's name.
        description (StringField): The field for the facility's description.
        avatar (StringField): The field for the facility's avatar.
        address_id (FormField): The field for the facility's address, using the AddressAddForm.
        organization_id (SelectField): The field for selecting the facility's organization.
        factions (HiddenField): The hidden field for storing the facility's factions.
        submit (SubmitField): The field for submitting the form.
    """

    name = StringField("Name", validators=[InputRequired("Name required!")])
    description = TextAreaField("Description")
    avatar = StringField("Avatar")
    address_id = FormField(AddressForm, label="Address")
    organization_id = SelectField(
        "Organization", coerce=int, validators=[InputRequired("Organization required!")]
    )
    factions = HiddenField("Factions", default=0)
    submit = SubmitField("Submit")

class FacultyForm(UserForm):
    """
    Class representing a Faculty Form.

    This class represents a form for creating a Faculty. It includes fields for the faculty's 
    first name, last name, facility ID, and department ID. The form can be submitted to create
    the faculty.

    Attributes:
        first_name (StringField): The field for the faculty's first name.
        last_name (StringField): The field for the faculty's last name.
        facility_id (SelectField): The field for selecting the faculty's faction.
        department_id (SelectField): The field for selecting the faculty's organization.
        submit (SubmitField): The field for submitting the form.
    """

    first_name = StringField("First Name", validators=[InputRequired()])
    last_name = StringField("Last Name", validators=[InputRequired()])
    facility_id = SelectField(
        "Facility", coerce=int, validators=[InputRequired("Facility required!")]
    )
    department_id = SelectField(
        "Department", coerce=int, validators=[InputRequired("Department required!")]
    )

    submit = SubmitField("Submit")

class DepartmentForm(FlaskForm):
    """
    Class representing a Department Form.

    This class represents a form for adding a new department. It includes fields for the
    department's name, description, avatar, and facility. The form can be submitted to add
    the department to the database.

    Attributes:
        name (StringField): The field for the department's name.
        description (StringField): The field for the department's description.
        avatar (StringField): The field for the department's avatar.
        facility_id (SelectField): The field for selecting the department's facility.
        submit (SubmitField): The field for submitting the form.
    """

    name = StringField("Name", validators=[InputRequired("Name required!")])
    description = TextAreaField("Description")
    avatar = StringField("Avatar")
    facility_id = SelectField(
        "Facility", coerce=int, validators=[InputRequired("Facility required!")]
    )
    submit = SubmitField("Submit")

class QuartersForm(FlaskForm):
    """
    Class representing a Quarters Form.

    This class represents a form for adding a new quarters. It includes fields for the
    quarters's name, description, avatar, and facility. The form can be submitted to add
    the quarters to the database.

    Attributes:
        name (StringField): The field for the quarters's name.
        description (StringField): The field for the quarters's description.
        avatar (StringField): The field for the quarters's avatar.
        facility_id (SelectField): The field for selecting the quarters's facility.
        quarters_type (SelectField): The field for selecting the quarters's type.
        submit (SubmitField): The field for submitting the form.
    """

    name = StringField("Name", validators=[InputRequired("Name required!")])
    description = TextAreaField("Description")
    avatar = StringField("Avatar")
    facility_id = SelectField(
        "Facility", coerce=int, validators=[InputRequired("Facility required!")]
    )
    quarters_type = SelectField(
        "Quarters Type", coerce=int, validators=[InputRequired("Quarters Type required!")]
    )
    submit = SubmitField("Submit")
