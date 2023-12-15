""" This module contains the models for the Leader Blueprint."""
from datetime import datetime
from ..database import db, CRUDMixin
from ..user.models import User

# Leader Related Models
class Leader(User):
    """
    Class representing a Leader.

    This class represents a Leader, which is a type of User in the system. A Leader has a user ID, a user role, and can be associated with a Faction and a Leader Enrollment.

    Attributes:
        user_id (int): The ID of the User associated with the Leader.
        user_role (str): The role of the Leader.
        faction_id (int): The ID of the Faction associated with the Leader.
        enrollment_id (int): The ID of the Leader Enrollment associated with the Leader.

    Methods:
        __repr__(): Returns a string representation of the Leader.
        __init__(*args, **kwargs): Initializes a new Leader instance.
    """

    __tablename__ = "leader"
    user_id = db.Column(db.Integer, db.ForeignKey("user.id"), primary_key=True)
    user_role = db.Column(db.String(255), nullable=False, default="leader")
    faction_id = db.Column(db.Integer, db.ForeignKey("faction.id"))
    enrollment_id = db.Column(db.Integer, db.ForeignKey("leader_enrollment.id"))

    def __repr__(self):
        return f"<Leader(user_id='{self.user_id}', user_role='{self.user_role}', enrollment_id='{self.enrollment_id}', faction_id='{self.faction_id}')>"

    def __init__(self, *args, **kwargs):
        super().__init__(*args, **kwargs)
        self.user_role = "leader"

class LeaderEnrollment(CRUDMixin, db.Model):
    """
    Class representing a Leader Enrollment.

    This class represents the enrollment of a Leader in a Faction for a specific quarter. It has an ID, references to the Leader, Faction Enrollment, and Quarters it belongs to, and timestamps for creation and update.

    Attributes:
        id (int): The unique ID of the Leader Enrollment.
        leader_id (int): The ID of the Leader associated with the enrollment.
        faction_enrollment_id (int): The ID of the Faction Enrollment associated with the enrollment.
        quarters_id (int): The ID of the Quarters associated with the enrollment.
        created_at (datetime): The timestamp of when the Leader Enrollment was created.
        updated_at (datetime): The timestamp of when the Leader Enrollment was last updated.

    Methods:
        __repr__(): Returns a string representation of the Leader Enrollment.
    """

    __tablename__ = "leader_enrollment"
    id = db.Column(db.Integer, primary_key=True, autoincrement="auto")
    leader_id = db.Column(db.Integer, db.ForeignKey('leader.user_id'))
    faction_enrollment_id = db.Column(db.Integer, db.ForeignKey('faction_enrollment.id'))
    quarters_id = db.Column(db.Integer, db.ForeignKey('quarters.id'))
    created_at = db.Column(db.DateTime(timezone=True), default=datetime.utcnow)
    updated_at = db.Column(db.DateTime(timezone=True), default=datetime.utcnow)

    def __repr__(self):
        return f"<LeaderEnrollment(leader_id='{self.leader_id}', faction_enrollment_id='{self.faction_enrollment_id}', quarters_id='{self.quarters_id}')>"
