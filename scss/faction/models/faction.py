""" Faction Model. """
from sqlalchemy import Column, Integer, String, Text, ForeignKey
from sqlalchemy.orm import relationship

from ...database import db, BaseMixin, CRUDMixin, AuditMixin, SlugMixin

class Faction(BaseMixin, CRUDMixin, AuditMixin, SlugMixin, db.Model):
    """ Faction Model. """
    __tablename__ = "faction"

    name = Column(String(255), nullable=False)
    abbreviation = Column(String(255), nullable=False)
    description = Column(Text(255), nullable=False)
    avatar_url = Column(String(255))

    # Relationships
    organization_id = Column(Integer, ForeignKey("organization.id"))
    organization = relationship("Organization", backref="faction", lazy=True)

    parent_id = Column(Integer, ForeignKey("faction.id"))
    parent = relationship(
        "Faction", remote_side=[id], backref="children", overlaps="children"
    )

    address_id = Column(Integer, ForeignKey("address.id"))
    address = relationship("Address", back_populates="faction")

    attendees = relationship("Attendee", lazy=True)
    leaders = relationship("Leader", backref="faction", lazy=True)
    enrollments = relationship("FactionEnrollment", lazy=True)
