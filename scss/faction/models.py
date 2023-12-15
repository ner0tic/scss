""" This module contains the models for the Faction Blueprint."""
from datetime import datetime
from ..database import db, CRUDMixin
from ..attendee.models import Attendee

# Faction Related Models
class Faction(CRUDMixin, db.Model):
    """Class representing a Faction.

    This class represents a Faction in the system. A Faction is a group or organization within an Organization. It has a name, a short name, a description, and an optional avatar URL. It can have a parent Faction, and can have attendees, leaders, and enrollments associated with it. It also has timestamps for creation and update.

    Args:
        name (str): The name of the Faction.
        short_name (str): The short name of the Faction.
        description (str): The description of the Faction.
        avatar_url (str, optional): The URL of the avatar for the Faction.
        organization_id (int, optional): The ID of the Organization that the Faction belongs to.
        parent_id (int, optional): The ID of the parent Faction.

    Attributes:
        id (int): The unique ID of the Faction.
        parent (Faction): The parent Faction of the Faction.
        children (List[Faction]): The child Factions of the Faction.
        attendees (List[Attendee]): The attendees associated with the Faction.
        leaders (List[Leader]): The leaders associated with the Faction.
        enrollments (List[FactionEnrollment]): The enrollments associated with the Faction.
        created_at (datetime): The timestamp of when the Faction was created.
        updated_at (datetime): The timestamp of when the Faction was last updated.

    Methods:
        __repr__(): Returns a string representation of the Faction.
        __init__(*args, **kwargs): Initializes a new Faction instance."""

    __tablename__ = "faction"
    id = db.Column(db.Integer, primary_key=True, autoincrement="auto")
    name = db.Column(db.String(255), nullable=False)
    short_name = db.Column(db.String(255), nullable=False)
    description = db.Column(db.Text(255), nullable=False)
    avatar_url = db.Column(db.String(255))
    organization_id = db.Column(db.Integer, db.ForeignKey("organization.id"))
    parent_id = db.Column(db.Integer, db.ForeignKey("faction.id"))
    parent = db.relationship(
        "Faction", remote_side=[id], backref="children", overlaps="children"
    )
    attendees = db.relationship("Attendee", backref="faction", lazy=True)
    leaders = db.relationship("Leader", backref="faction", lazy=True)
    enrollments = db.relationship("FactionEnrollment", backref="faction", lazy=True)
    created_at = db.Column(db.DateTime(timezone=True), default=datetime.utcnow)
    updated_at = db.Column(db.DateTime(timezone=True), default=datetime.utcnow)

    def __repr__(self) -> str:
        attributes = [
            "name",
            "short_name",
            "description",
            "avatar_url",
            "organization_id",
            "parent_id",
            "created_at",
            "updated_at",
        ]
        attr_pairs = ", ".join(f"{attr}='{getattr(self, attr)}'" for attr in attributes)

        return f"<Faction({attr_pairs})>"

    def __init__(self, *args, **kwargs):
        super().__init__(*args, **kwargs)
        self.short_name = self.name

class FactionEnrollment(CRUDMixin, db.Model):
    """ Class representing a Faction Enrollment.

        This class represents the enrollment of a Faction in a facility for a specific quarter. It has an ID, references to the Faction, Facility Enrollment, and Quarters it belongs to, and timestamps for creation and update.

        Attributes:
            id (int): The unique ID of the Faction Enrollment.
            faction_id (int): The ID of the Faction associated with the enrollment.
            facility_enrollment_id (int): The ID of the Facility Enrollment associated with the enrollment.
            quarters_id (int): The ID of the Quarters associated with the enrollment.
            created_at (datetime): The timestamp of when the Faction Enrollment was created.
            updated_at (datetime): The timestamp of when the Faction Enrollment was last updated.
    """

    __tablename__ = 'faction_enrollment'
    id = db.Column(db.Integer, primary_key = True, autoincrement = "auto")
    faction_id = db.Column(db.Integer, db.ForeignKey('faction.id'))
    facility_enrollment_id = db.Column(db.Integer, db.ForeignKey('facility_enrollment.id'))
    quarters_id = db.Column(db.Integer, db.ForeignKey('quarters.id'))
    created_at = db.Column(db.DateTime(timezone=True), default=datetime.utcnow)
    updated_at = db.Column(db.DateTime(timezone=True), default=datetime.utcnow)






