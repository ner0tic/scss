'''Enrollment Related Models'''
import datetime
from scss.database import db, CRUDMixin

# Organization Related Models.
class Organization(CRUDMixin, db.Model):
    """
    Represents an organization.

    Attributes:
        id (int): The unique identifier of the organization.
        name (str): The name of the organization.
        short_name (str): The short name of the organization.
        description (str): The description of the organization.
        avatar_url (str): The URL of the organization's avatar.
        councils (list): The list of councils associated with the organization.
        created_at (datetime): The timestamp when the organization was created.
        updated_at (datetime): The timestamp when the organization was last updated.
    """
    __tablename__ = "organization"
    id = db.Column(db.Integer, primary_key=True, autoincrement="auto")
    name = db.Column(db.String(255), nullable=False)
    short_name = db.Column(db.String(50))
    description = db.Column(db.String(255), nullable=False)
    avatar_url = db.Column(db.String(255))
    parent_id = db.Column(db.Integer, db.ForeignKey('organization.id'))
    parent = db.relationship("Organization", remote_side=[id], backref="children", overlaps="children")
#     children = relationship('Organization', remote_side=[parent_id], backref="parent", overlaps="parent", uselist=True)
    facilities = db.relationship("Facility", backref="organization", lazy=True)
    factions = db.relationship("Faction", backref="organization", lazy=True)
    created_at = db.Column(
        db.DateTime(timezone=True),
        default=datetime.datetime.utcnow
    )
    updated_at = db.Column(
        db.DateTime(timezone=True),
        default=datetime.datetime.utcnow
    )

    def __repr__(self):
        return f"{self.__class__.__name__}({self.name!r})"
