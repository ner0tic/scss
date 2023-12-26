""" Faction forms """
from flask_wtf import FlaskForm
from wtforms import StringField, SubmitField, SelectField, FormField
from wtforms.validators import InputRequired
from ..utils.forms import AddressForm, DeleteConfirmationForm
from ..user.forms import UserForm

###############################################################################################
# Faction Related Forms #######################################################################
###############################################################################################
class FactionEnrollmentAddForm(FlaskForm):
    faction_id = StringField("Faction ID")
    temporal_hierarchy_id = StringField("Temporal Hierarchy ID")
    quarters_id = StringField("Quarters ID")
    
class FactionForm(FlaskForm):
    name = StringField("Name", validators=[InputRequired("Name required!")])
    short_name = StringField("Short Name")
    description = StringField("Description")
    avatar_url = StringField("Avatar")
#    address_id = FormField(AddressForm, label="Address")
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
    submit = SubmitField("Submit")

class FactionDeleteForm(DeleteConfirmationForm):
    pass

###############################################################################################
# Attendee Related Forms ######################################################################
###############################################################################################
class AttendeeForm(UserForm):
    """
    Class representing an Attendee Form.

    This class represents a form for creating an Attendee. It includes fields for the attendee's
    first name, last name, faction ID, and organization ID. The form can be submitted to create
    the attendee.

    Attributes:
        first_name (StringField): The field for the attendee's first name.
        last_name (StringField): The field for the attendee's last name.
        faction_id (SelectField): The field for selecting the attendee's faction.
        organization_id (SelectField): The field for selecting the attendee's organization.
        submit (SubmitField): The field for submitting the form.
    """

    first_name = StringField("First Name", validators=[InputRequired()])
    last_name = StringField("Last Name", validators=[InputRequired()])
    faction_id = SelectField(
        "Faction", coerce=int, validators=[InputRequired("Faction required!")]
    )
    organization_id = SelectField(
        "Organization", coerce=int, validators=[InputRequired("Organization required!")]
    )

    submit = SubmitField("Submit")

class AttendeeEnrollmentForm(FlaskForm):
    """
    Class representing an Edit Attendee Enrollment Form.

    This class represents a form for editing the enrollment details of an Attendee. It includes fields for selecting the attendee, faction enrollment, and quarters. The form can be submitted to update the attendee's enrollment information.

    Attributes:
        attendee_id (SelectField): The field for selecting the attendee.
        faction_enrollment_id (SelectField): The field for selecting the faction enrollment.
        quarters_id (SelectField): The field for selecting the quarters.
        submit (SubmitField): The field for submitting the form.
    """

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

    submit = SubmitField("Submit")


class AttendeeFacilityClassEnrollmentForm(FlaskForm):
    """
    Class representing an Edit Attendee Facility Class Enrollment Form.

    This class represents a form for editing the enrollment details of an Attendee in a Facility Class. It includes fields for selecting the attendee enrollment and facility class. The form can be submitted to update the attendee's facility class enrollment information.

    Attributes:
        attendee_enrollment_id (SelectField): The field for selecting the attendee enrollment.
        facility_class_id (SelectField): The field for selecting the facility class.
        submit (SubmitField): The field for submitting the form.
    """

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

    submit = SubmitField("Submit")

###############################################################################################
# Leader Related Forms ########################################################################
###############################################################################################
class LeaderForm(UserForm):
    """
    Class representing a Leader Form.

    This class represents a form for creating a Leader. It includes fields for the leader's
    first name, last name, and faction ID. The form can be submitted to create the leader.

    Attributes:
        first_name (StringField): The field for the leader's first name.
        last_name (StringField): The field for the leader's last name.
        faction_id (SelectField): The field for selecting the leader's faction.
        organization_id (SelectField): The field for selecting the leader's organization.
        submit (SubmitField): The field for submitting the form.
    """

    first_name = StringField("First Name", validators=[InputRequired()])
    last_name = StringField("Last Name", validators=[InputRequired()])
    faction_id = SelectField(
        "Faction", coerce=int, validators=[InputRequired("Faction required!")]
    )
    organization_id = SelectField(
        "Organization", coerce=int, validators=[InputRequired("Organization required!")]
    )

    submit = SubmitField("Submit")
