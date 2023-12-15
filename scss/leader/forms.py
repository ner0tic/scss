""" This file contains forms for the Leader blueprint. """
from flask_wtf import FlaskForm
from wtforms import StringField, SubmitField, SelectField
from wtforms.validators import InputRequired

class EditLeaderForm(FlaskForm):
    """
    Class representing an Edit Leader Form.

    This class represents a form for editing the details of a Leader. It includes fields for the leader's first name, last name, faction ID, and organization ID. The form can be submitted to update the leader's information.

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


class EditLeaderEnrollmentForm(FlaskForm):
    """
    Class representing an Edit Leader Enrollment Form.

    This class represents a form for editing the enrollment details of a Leader. It includes fields for selecting the leader, faction enrollment, and quarters. The form can be submitted to update the leader's enrollment information.

    Attributes:
        leader_id (SelectField): The field for selecting the leader.
        faction_enrollment_id (SelectField): The field for selecting the faction enrollment.
        quarters_id (SelectField): The field for selecting the quarters.
        submit (SubmitField): The field for submitting the form.
    """

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

    submit = SubmitField("Submit")
