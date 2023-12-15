from flask import Flask
from flask_wtf import FlaskForm
from wtforms import (
    StringField,
    PasswordField,
    SubmitField,
    SelectField,
    HiddenField,
    BooleanField,
    FormField,
)
from wtforms.validators import InputRequired, Length
from wtform_address import CountrySelectField, StateSelectField

class UserAddForm(FlaskForm):

    username = StringField(
        "Username",
        validators=[
            InputRequired("Username required!"),
            Length(min=5, max=25, message="Username must be in 5 to 25 characters"),
        ],
    )
    password = PasswordField(
        "Password", validators=[InputRequired("Password required!")]
    )
    email = StringField(
        "Email",
        validators=[
            InputRequired("Email required!"),
            Length(min=5, max=25, message="Email must be in 5 to 25 characters"),
        ],
    )
    first_name = StringField("First Name")
    last_name = StringField("Last Name")
    address_id = StringField("Address ID")
    avatar_url = StringField("Avatar URL")
    role = StringField("Role")
    last_seen = StringField("Last Seen")


class AdminAddForm(FlaskForm):
    user_id = StringField("User ID")
    user_role = StringField(
        "User Role", validators=[InputRequired("User Role required!")]
    )
    organization_id = SelectField(
        "Organization", coerce=int, validators=[InputRequired("Organization required!")]
    )


class AddressAddForm(FlaskForm):
    # name = StringField('Name')
    line1 = StringField("Address", validators=[InputRequired("Line 1 required!")])
    line2 = StringField("Address Line 2")
    city = StringField("City", validators=[InputRequired("City required!")])
    state = StateSelectField(
        default="US-ME"
    )  # StringField('State', validators=[InputRequired('State required!')])
    postal_code = StringField(
        "Postal Code", validators=[InputRequired("Postal Code required!")]
    )
    country = CountrySelectField(
        default="US"
    )  # StringField('Country', validators=[InputRequired('Country required!')])
    # submit = SubmitField('Submit')


class FactionAddForm(FlaskForm):
    name = StringField(
        "Faction Name", validators=[InputRequired("Faction Name required!")]
    )
    short_name = StringField(
        "Short Name", validators=[InputRequired("Faction Short Name required!")]
    )
    description = StringField(
        "Description", validators=[InputRequired("Faction Description required!")]
    )
    avatar_url = StringField("Avatar URL")
    organization_id = SelectField(
        "Organization", coerce=int, validators=[InputRequired("Organization required!")]
    )
    parent = SelectField(
        "Faction Parent",
        coerce=int,
        validators=[InputRequired("Faction Parent required!")],
    )
    leaders = HiddenField(
        "Faction Leaders", default=0
    )  # , validators=[InputRequired('Faction Leaders required!')])
    attendees = HiddenField(
        "Faction Attendees", default=0
    )  # , validators=[InputRequired('Faction Attendees required!')])


class AttendeeAddForm(FlaskForm):
    def __init__(self, label=None, validators=None, false_values=None, **kwargs):
        super().__init__(label=label, validators=validators, **kwargs)
        if false_values is not None:
            self.false_values = false_values

    user_id = StringField("User ID")
    user_role = StringField(
        "User Role", validators=[InputRequired("User Role required!")]
    )
    faction_id = StringField("Faction ID")
    patrol_id = StringField("Patrol ID")
    enrollment_id = StringField("Enrollment ID")


class LeaderAddForm(FlaskForm):
    user_id = StringField("User ID")
    user_role = StringField(
        "User Role", validators=[InputRequired("User Role required!")]
    )
    faction_id = StringField("Faction ID")
    enrollment_id = StringField("Enrollment ID")


class FacultyAddForm(FlaskForm):
    user_id = StringField("User ID")
    user_role = StringField(
        "User Role", validators=[InputRequired("User Role required!")]
    )
    enrollment_id = StringField("Enrollment ID")
    facility_id = StringField("Facility ID")
    department_id = StringField("Department ID")


class QuartersAddForm(FlaskForm):
    name = StringField("Name", validators=[InputRequired("Name required!")])
    description = StringField("Description")
    avatar = StringField("Avatar")
    quarters_type = StringField("Quarters Type")
    facility_id = StringField("Facility ID")
    parent_id = StringField("Parent ID")


class DepartmentAddForm(FlaskForm):
    name = StringField("Name")
    description = StringField("Description")
    avatar = StringField("Avatar")
    facility_id = StringField("Facility ID")
    parent_id = StringField("Parent ID")


class TemporalHierarchyAddForm(FlaskForm):
    name = StringField("Name", validators=[InputRequired("Name required!")])
    short_name = StringField("Short Name")
    description = StringField(
        "Description", validators=[InputRequired("Description required!")]
    )
    avatar_url = StringField("Avatar URL")
    parent_id = StringField("Parent ID")
    organization_id = StringField("Organization ID")





class FacultyEnrollmentAddForm(FlaskForm):
    faculty_id = StringField("Faculty ID")
    quarters_id = StringField("Quarters ID")
    temporal_hierarchy_id = StringField("Temporal Hierarchy ID")


class FacultyClassEnrollmentAddForm(FlaskForm):
    faculty_enrollment_id = StringField("Faculty Enrollment ID")
    facility_class_id = StringField("Facility Class ID")


class FacilityClassAddForm(FlaskForm):
    name = StringField("Name", validators=[InputRequired("Name required!")])
    course_id = StringField("Course ID")
    temporal_hierarchy_id = StringField("Temporal Hierarchy ID")
    faculty_id = StringField("Faculty ID")
    department_id = StringField("Department ID")
    capacity = StringField("Capacity")


class LeaderEnrollmentAddForm(FlaskForm):
    leader_id = StringField("Leader ID")
    faction_enrollment_id = StringField("Faction Enrollment ID")
    quarters_id = StringField("Quarters ID")


class AttendeeEnrollmentAddForm(FlaskForm):
    attendee_id = StringField("Attendee ID")
    faction_enrollment_id = StringField("Faction Enrollment ID")
    quarters_id = StringField("Quarters ID")


class AttendeeClassEnrollmentAddForm(FlaskForm):
    attendee_enrollment_id = StringField("Attendee Enrollment ID")
    facility_class_id = StringField("Facility Class ID")


class RequirementAddForm(FlaskForm):
    name = StringField("Name", validators=[InputRequired("Name required!")])
    description = StringField(
        "Description", validators=[InputRequired("Description required!")]
    )
    parent_id = StringField("Parent ID")
    organization_id = StringField("Organization ID")
    optional = StringField("Optional")
    course_id = StringField("Course ID")


class CourseAddForm(FlaskForm):
    name = StringField("Name", validators=[InputRequired("Name required!")])
    description = StringField(
        "Description", validators=[InputRequired("Description required!")]
    )
    avatar_url = StringField("Avatar URL")
    organization_id = StringField("Organization ID")


class LoginForm(FlaskForm):
    email = StringField(
        "Email",
        validators=[
            InputRequired("Email required!"),
            Length(min=5, max=25, message="Email must be in 5 to 25 characters"),
        ],
    )
    password = PasswordField(
        "Password", validators=[InputRequired("Password required!")]
    )
    remember = BooleanField("Remember Me")
    submit = SubmitField("Login")


class RegistrationForm(FlaskForm):
    username = StringField(
        "Username",
        validators=[
            InputRequired("Username required!"),
            Length(min=5, max=25, message="Username must be in 5 to 25 characters"),
        ],
    )
    password = PasswordField(
        "Password", validators=[InputRequired("Password required!")]
    )
    confirm_password = PasswordField(
        "Confirm Password", validators=[InputRequired("Confirm Password required!")]
    )
    email = StringField(
        "Email",
        validators=[
            InputRequired("Email required!"),
            Length(min=5, max=25, message="Email must be in 5 to 25 characters"),
        ],
    )
    first_name = StringField("First Name")
    last_name = StringField("Last Name")
    address_id = FormField(AddressAddForm, label="Address")  # StringField('Address ID')
    avatar_url = StringField("Avatar URL")
    role = HiddenField("Role", default="user")
    # last_seen = StringField('Last Seen')
    submit = SubmitField("Register")
