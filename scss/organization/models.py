""" This module defines the models for the organization blueprint. """
import datetime
from sqlalchemy import Column, Integer, String, Text, DateTime, ForeignKey
from sqlalchemy.orm import relationship
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
        - Returns a String representation of the organization.
    """
    __tablename__ = "organization"

    id = Column(Integer, primary_key=True, autoincrement="auto")
    name = Column(String(255), nullable=False)
    abbreviation = Column(String(50))
    description = Column(Text)
    avatar_url = Column(String(255))
    slug = Column(String(255), nullable=False, unique=True)

    # Relationships
    parent_id = Column(Integer, ForeignKey('organization.id'))
    parent = relationship("Organization", remote_side=[id])

    address_id = Column(Integer, ForeignKey('address.id'))
    address = relationship("Address")


    facilities = relationship("Facility", backref="organization", lazy=True)
    factions = relationship("Faction", backref="organization", lazy=True)

    # Timestamps
    created_at = Column(
        DateTime(timezone=True),
        default=datetime.datetime.utcnow
    )
    updated_at = Column(
        DateTime(timezone=True),
        default=datetime.datetime.utcnow
    )

    def __repr__(self):
        return f"{self.__class__.__name__}({self.name!r})"

    def __str__(self):
        return self.name
