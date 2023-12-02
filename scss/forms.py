from flask import Flask
from flask_wtf import FlaskForm 
from wtforms import StringField, PasswordField ,SubmitField, TextAreaField, SelectField, HiddenField
from wtforms.validators import InputRequired, Length
from scss.models import User, Organization, Faction

"""
The `OrganizationAddForm` class represents a form for adding an organization.

Args:
    organization_name (str): The name of the organization.
    organization_short_name (str): The short name of the organization.
    organization_description (str): The description of the organization.
    organization_avatar_url (str): The URL of the organization's avatar.
    organization_parent (int): The ID of the parent organization.
    organization_factions (int): The number of factions associated with the organization.

Attributes:
    submit: A submit button.

Returns:
    None

"""
class OrganizationAddForm(FlaskForm):
    organization_name = StringField('Organization Name', validators=[InputRequired('Organization Name required!'),  
               Length(min=5, max=25, message='Organization Name must be in 5 to 25 characters')])
    organization_short_name = StringField('Organization Short Name', validators=[Length(min=2, max=25, message='Organization Short Name must be in 3 to 25 characters')])
    organization_description = TextAreaField('Organization Description', validators=[Length(min=5, max=25, message='Organization Description must be in 5 to 25 characters')])
    organization_avatar_url = StringField('Organization Avatar URL')
    organization_parent = SelectField('Organization Parent', coerce=int, validators=[InputRequired('Organization Parent required!')])
    organization_factions = HiddenField('Organization Factions', default=0) # , validators=[InputRequired('Organization Factions required!')])
    submit = SubmitField('Submit')

class UserAddForm(FlaskForm):
    username = StringField('Username', validators=[InputRequired('Username required!'),
               Length(min=5, max=25, message='Username must be in 5 to 25 characters')])
    password = PasswordField('Password', validators=[InputRequired('Password required!')])
    email = StringField('Email', validators=[InputRequired('Email required!'), 
               Length(min=5, max=25, message='Email must be in 5 to 25 characters')])
    first_name = StringField('First Name')
    last_name = StringField('Last Name')
    address_id = StringField('Address ID')
    avatar_url = StringField('Avatar URL')
    role = StringField('Role')
    last_seen = StringField('Last Seen')

class AdminAddForm(FlaskForm):
    user_id = StringField('User ID')
    user_role = StringField('User Role', validators=[InputRequired('User Role required!')])
    organization_id = SelectField('Organization', coerce=int, validators=[InputRequired('Organization required!')])

class AddressAddForm(FlaskForm):
    name = StringField('Name')
    line1 = StringField('Line 1', validators=[InputRequired('Line 1 required!')])
    line2 = StringField('Line 2')
    city = StringField('City', validators=[InputRequired('City required!')])
    state = StringField('State', validators=[InputRequired('State required!')])
    postal_code = StringField('Postal Code', validators=[InputRequired('Postal Code required!')])
    country = StringField('Country', validators=[InputRequired('Country required!')])


class FactionAddForm(FlaskForm):
    name = StringField('Faction Name', validators=[InputRequired('Faction Name required!')])
    short_name = StringField('Short Name', validators=[InputRequired('Faction Short Name required!')])
    description = StringField('Description', validators=[InputRequired('Faction Description required!')])
    avatar_url = StringField('Avatar URL')
    organization_id = SelectField('Organization', coerce=int, validators=[InputRequired('Organization required!')])
    parent = SelectField('Faction Parent', coerce=int, validators=[InputRequired('Faction Parent required!')])
    leaders = HiddenField('Faction Leaders', default=0) # , validators=[InputRequired('Faction Leaders required!')])
    attendees = HiddenField('Faction Attendees', default=0) # , validators=[InputRequired('Faction Attendees required!')])

class AttendeeAddForm(FlaskForm):
    user_id = StringField('User ID')
    user_role = StringField('User Role', validators=[InputRequired('User Role required!')])
    faction_id = StringField('Faction ID')
    patrol_id = StringField('Patrol ID')
    enrollment_id = StringField('Enrollment ID')

class LeaderAddForm(FlaskForm):
    user_id = StringField('User ID')
    user_role = StringField('User Role', validators=[InputRequired('User Role required!')])
    faction_id = StringField('Faction ID')
    enrollment_id = StringField('Enrollment ID')

class FacilityAddForm(FlaskForm):
    name = StringField('Name', validators=[InputRequired('Name required!')])
    description = StringField('Description')
    avatar = StringField('Avatar')
    address_id = StringField('Address ID')

class FacultyAddForm(FlaskForm):
    user_id = StringField('User ID')
    user_role = StringField('User Role', validators=[InputRequired('User Role required!')])
    enrollment_id = StringField('Enrollment ID')
    facility_id = StringField('Facility ID')
    department_id = StringField('Department ID')

class QuartersAddForm(FlaskForm):
    name = StringField('Name', validators=[InputRequired('Name required!')])
    description = StringField('Description')
    avatar = StringField('Avatar')
    quarters_type = StringField('Quarters Type')
    facility_id = StringField('Facility ID')
    parent_id = StringField('Parent ID')

class DepartmentAddForm(FlaskForm):
    name = StringField('Name')
    description = StringField('Description')
    avatar = StringField('Avatar')
    facility_id = StringField('Facility ID')
    parent_id = StringField('Parent ID')

class TemporalHierarchyAddForm(FlaskForm):
    name = StringField('Name', validators=[InputRequired('Name required!')])
    short_name = StringField('Short Name')
    description = StringField('Description', validators=[InputRequired('Description required!')])
    avatar_url = StringField('Avatar URL')
    parent_id = StringField('Parent ID')
    organization_id = StringField('Organization ID')

class FactionEnrollmentAddForm(FlaskForm):
    faction_id = StringField('Faction ID')
    temporal_hierarchy_id = StringField('Temporal Hierarchy ID')
    quarters_id = StringField('Quarters ID')

class FacultyEnrollmentAddForm(FlaskForm):
    faculty_id = StringField('Faculty ID')
    quarters_id = StringField('Quarters ID')
    temporal_hierarchy_id = StringField('Temporal Hierarchy ID')

class FacultyClassEnrollmentAddForm(FlaskForm):
    faculty_enrollment_id = StringField('Faculty Enrollment ID')
    facility_class_id = StringField('Facility Class ID')

class FacilityClassAddForm(FlaskForm):
    name = StringField('Name', validators=[InputRequired('Name required!')])
    course_id = StringField('Course ID')
    temporal_hierarchy_id = StringField('Temporal Hierarchy ID')
    faculty_id = StringField('Faculty ID')
    department_id = StringField('Department ID')
    capacity = StringField('Capacity')

class LeaderEnrollmentAddForm(FlaskForm):
    leader_id = StringField('Leader ID')
    faction_enrollment_id = StringField('Faction Enrollment ID')
    quarters_id = StringField('Quarters ID')

class AttendeeEnrollmentAddForm(FlaskForm):
    attendee_id = StringField('Attendee ID')
    faction_enrollment_id = StringField('Faction Enrollment ID')
    quarters_id = StringField('Quarters ID')

class AttendeeClassEnrollmentAddForm(FlaskForm):
    attendee_enrollment_id = StringField('Attendee Enrollment ID')
    facility_class_id = StringField('Facility Class ID')

class RequirementAddForm(FlaskForm):
    name = StringField('Name', validators=[InputRequired('Name required!')])
    description = StringField('Description', validators=[InputRequired('Description required!')])
    parent_id = StringField('Parent ID')
    organization_id = StringField('Organization ID')
    optional = StringField('Optional')
    course_id = StringField('Course ID')

class CourseAddForm(FlaskForm):
    name = StringField('Name', validators=[InputRequired('Name required!')])
    description = StringField('Description', validators=[InputRequired('Description required!')])
    avatar_url = StringField('Avatar URL')
    organization_id = StringField('Organization ID')
