""" This module defines the models for the organization blueprint. """
import datetime
from ..database import db, CRUDMixin

# Organization Related Models.
class Organization(CRUDMixin, db.Model):
    """
    ## Organization

    Represents an organization.

    ### Attributes
    - `id` (int): The unique identifier of the organization.
    - `name` (str): The name of the organization.
    - `short_name` (str): The short name of the organization.
    - `description` (str): The description of the organization.
    - `avatar_url` (str): The URL of the organization's avatar.
    - `parent_id` (int): The ID of the parent organization.
    - `address_id` (int): The ID of the organization's address.
    - `slug` (str): The slug of the organization.
    - `parent` (Organization): The parent organization.
    - `address` (Address): The address of the organization.
    - `facilities` (list): The list of facilities associated with the organization.
    - `factions` (list): The list of factions associated with the organization.
    - `created_at` (datetime): The timestamp when the organization was created.
    - `updated_at` (datetime): The timestamp when the organization was last updated.

    ### Methods
    - `__repr__()`:
        - Returns a string representation of the organization.
    """

    __tablename__ = "organization"
    id = db.Column(db.Integer, primary_key=True, autoincrement="auto")
    name = db.Column(db.String(255), nullable=False)
    short_name = db.Column(db.String(50))
    description = db.Column(db.String(255), nullable=False)
    avatar_url = db.Column(db.String(255))
    parent_id = db.Column(db.Integer, db.ForeignKey('organization.id'))
#    address_id = db.Column(db.Integer, db.ForeignKey('address.id'))
#    slug = db.Column(db.String(255), nullable=False, unique=True)
    # Relationships
    parent = db.relationship("Organization", remote_side=[id], backref="children")
#    address = db.relationship("Address", backref="organization", lazy=True)
    facilities = db.relationship("Facility", backref="organization", lazy=True)
    factions = db.relationship("Faction", backref="organization", lazy=True)
    # Timestamps
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
