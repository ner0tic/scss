""" Faction Related Forms. """
from flask_wtf import FlaskForm

from wtforms import StringField, SubmitField, SelectField, FormField
from wtforms.validators import InputRequired

from ..utils.forms import DeleteConfirmationForm

from ..address.forms import AddressForm
from ..user.forms import UserForm

###############################################################################################
# Faction Related Forms #######################################################################
###############################################################################################
class FactionEnrollmentAddForm(FlaskForm):
    """ Faction Enrollment Form. """
    faction_id = StringField("Faction ID")
    temporal_hierarchy_id = StringField("Temporal Hierarchy ID")
    quarters_id = StringField("Quarters ID")


class FactionForm(FlaskForm):
    """ Faction Form. """
    name = StringField("Name", validators=[InputRequired("Name required!")])
    short_name = StringField("Short Name")
    description = StringField("Description")
    avatar_url = StringField("Avatar")
    # address_id = FormField(AddressForm, label="Address")
    organization_id = SelectField(
        "Organization",
        coerce=int,
        validators=[InputRequired("Organization required!")]
    )
    parent = SelectField(
        "Parent",
        coerce=int,
        validators=[InputRequired("Parent required!")]
    )
    # submit = SubmitField("Submit")


class FactionDeleteForm(DeleteConfirmationForm):
    """ Faction Deletion Form. """
    pass


###############################################################################################
# Attendee Related Forms ######################################################################
###############################################################################################
class AttendeeForm(UserForm):
    """ Attendee Form. """

    first_name = StringField("First Name", validators=[InputRequired()])
    last_name = StringField("Last Name", validators=[InputRequired()])
    faction_id = SelectField(
        "Faction", coerce=int, validators=[InputRequired("Faction required!")]
    )
    organization_id = SelectField(
        "Organization", coerce=int, validators=[InputRequired("Organization required!")]
    )

    # submit = SubmitField("Submit")


class AttendeeEnrollmentForm(FlaskForm):
    """ Attendee Enrollment Form. """
    attendee_id = SelectField(
        "Attendee", coerce=int, validators=[InputRequired("Attendee required!")]
    )
    faction_enrollment_id = SelectField(
        "Faction Enrollment",
        coerce=int,
        validators=[InputRequired("Faction Enrollment required!")],
    )
    quarters_id = SelectField(
        "Quarters", coerce=int, validators=[InputRequired("Quarters required!")]
    )
    # submit = SubmitField("Submit")


class AttendeeFacilityClassEnrollmentForm(FlaskForm):
    """ Attendee Facility Class Enrollment Form."""
    attendee_enrollment_id = SelectField(
        "Attendee Enrollment",
        coerce=int,
        validators=[InputRequired("Attendee Enrollment required!")],
    )
    facility_class_id = SelectField(
        "Facility Class",
        coerce=int,
        validators=[InputRequired("Facility Class required!")],
    )
    # submit = SubmitField("Submit")


###############################################################################################
# Leader Related Forms ########################################################################
###############################################################################################
class LeaderForm(UserForm):
    """ Leader Form. """
    first_name = StringField("First Name", validators=[InputRequired()])
    last_name = StringField("Last Name", validators=[InputRequired()])
    faction_id = SelectField(
        "Faction", coerce=int, validators=[InputRequired("Faction required!")]
    )
    organization_id = SelectField(
        "Organization", coerce=int, validators=[InputRequired("Organization required!")]
    )
    # submit = SubmitField("Submit")


class LeaderEnrollmentForm(FlaskForm):
    """ Leader Enrollment Form. """
    leader_id = SelectField(
        "Leader", coerce=int, validators=[InputRequired("Leader required!")]
    )
    faction_enrollment_id = SelectField(
        "Faction Enrollment",
        coerce=int,
        validators=[InputRequired("Faction Enrollment required!")],
    )
    quarters_id = SelectField(
        "Quarters", coerce=int, validators=[InputRequired("Quarters required!")]
    )
    # submit = SubmitField("Submit")
