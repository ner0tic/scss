""" This module contains the models for the Faction Blueprint."""
from datetime import datetime
from ..database import db, CRUDMixin
from ..user.models import User

# Attendee Related Models
class Attendee(User):
    """Class representing an Attendee.

    This class represents an Attendee, which is a type of User in the system. An Attendee has a user ID, a user role, and can be associated with a Faction, an Attendee Enrollment, and an Organization.

    Attributes:
        user_id (int): The ID of the User associated with the Attendee.
        user_role (str): The role of the Attendee.
        faction_id (int): The ID of the Faction associated with the Attendee.
        enrollment_id (int): The ID of the Attendee Enrollment associated with the Attendee.
        organization_id (int): The ID of the Organization associated with the Attendee.

    Methods:
        __repr__(): Returns a string representation of the Attendee.
        __init__(*args, **kwargs): Initializes a new Attendee instance.
    """

    __tablename__ = "attendee"
    user_id = db.Column(db.Integer, db.ForeignKey("user.id"), primary_key=True)
    user_role = db.Column(db.String(255), nullable=False, default="attendee")
    faction_id = db.Column(db.Integer, db.ForeignKey("faction.id"))
    enrollment_id = db.Column(db.Integer, db.ForeignKey("attendee_enrollment.id"))
    organization_id = db.Column(db.Integer, db.ForeignKey("organization.id"))

    def __repr__(self):
        return f"<Attendee(user_id='{self.user_id}', user_role='{self.user_role}', enrollment_id='{self.enrollment_id}', faction_id='{self.faction_id}')>"

    def __init__(self, *args, **kwargs):
        super().__init__(*args, **kwargs)
        self.user_role = "attendee"

class AttendeeEnrollment(CRUDMixin, db.Model):
    """Class representing an Attendee Enrollment.

    This class represents the enrollment of an Attendee in a Faction for a specific quarter. It has an ID, references to the Attendee, Faction Enrollment, and Quarters it belongs to, a list of Attendee Class Enrollments associated with it, and timestamps for creation and update.

    Attributes:
        id (int): The unique ID of the Attendee Enrollment.
        attendee_id (int): The ID of the Attendee associated with the enrollment.
        faction_enrollment_id (int): The ID of the Faction Enrollment associated with the enrollment.
        quarters_id (int): The ID of the Quarters associated with the enrollment.
        attendee_facility_class_enrollments (List[AttendeeClassEnrollment]): The Attendee Class Enrollments associated with the Attendee Enrollment.
        created_at (datetime): The timestamp of when the Attendee Enrollment was created.
        updated_at (datetime): The timestamp of when the Attendee Enrollment was last updated.
    """

    __tablename__ = "attendee_enrollment"
    id = db.Column(db.Integer, primary_key=True, autoincrement="auto")
    attendee_id = db.Column(db.Integer, db.ForeignKey("attendee.user_id"))
    faction_enrollment_id = db.Column(
        db.Integer, db.ForeignKey("faction_enrollment.id")
    )
    quarters_id = db.Column(db.Integer, db.ForeignKey("quarters.id"))
    attendee_facility_class_enrollments = db.relationship(
        "AttendeeFacilityClassEnrollment", backref="attendee_enrollment"
    )
    created_at = db.Column(db.DateTime(timezone=True), default=datetime.utcnow)
    updated_at = db.Column(db.DateTime(timezone=True), default=datetime.utcnow)

class AttendeeFacilityClassEnrollment(CRUDMixin, db.Model):
    """Class representing an Attendee Class Enrollment.

    This class represents the enrollment of an Attendee in a Facility Class. It has an ID, references to the Attendee Enrollment and Facility Class it belongs to, and timestamps for creation and update.

    Attributes:
        id (int): The unique ID of the Attendee Class Enrollment.
        attendee_enrollment_id (int): The ID of the Attendee Enrollment associated with the enrollment.
        facility_class_id (int): The ID of the Facility Class associated with the enrollment.
        created_at (datetime): The timestamp of when the Attendee Class Enrollment was created.
        updated_at (datetime): The timestamp of when the Attendee Class Enrollment was last updated.
    """

    __tablename__ = "attendee_facility_class_enrollment"
    id = db.Column(db.Integer, primary_key=True, autoincrement="auto")
    attendee_enrollment_id = db.Column(
        db.Integer, db.ForeignKey("attendee_enrollment.id")
    )
    facility_class_id = db.Column(db.Integer, db.ForeignKey("facility_class.id"))
    created_at = db.Column(db.DateTime(timezone=True), default=datetime.utcnow)
    updated_at = db.Column(db.DateTime(timezone=True), default=datetime.utcnow)
