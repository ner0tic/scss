""" Organization Related Models. """
from sqlalchemy import Column, Integer, String, Text, ForeignKey
from sqlalchemy.orm import relationship

from ...database import db, BaseMixin, CRUDMixin, AuditMixin, SlugMixin

class Organization(BaseMixin, CRUDMixin, AuditMixin, SlugMixin, db.Model):
    """ Represents an organization. """
    __tablename__ = "organization"

    id = Column(Integer, primary_key=True)
    name = Column(String(255), nullable=False, unique=True)
    abbreviation = Column(String(50))
    description = Column(Text)
    avatar_url = Column(String(255))

    # Relationships
    parent_id = Column(Integer, ForeignKey('organization.id'))
    parent = relationship(
        "Organization",
        remote_side=[id],
        backref="children",
        overlaps="children"
    )

    address_id = Column(Integer, ForeignKey('address.id'))
    address = relationship("Address", back_populates="organization")

    facilities = relationship("Facility", lazy=True)
    factions = relationship("Faction", lazy=True)

    def __str__(self):
        return self.name
