""" Quarters Model. """
from sqlalchemy import Column, Integer, String, ForeignKey
from sqlalchemy.orm import relationship

from ...database import db, BaseMixin, CRUDMixin, AuditMixin, SlugMixin

class Quarters(BaseMixin, CRUDMixin, AuditMixin, SlugMixin, db.Model):
    """ Quarters Model. """
    # CONSTANTS
    FACTION_QUARTERS = 0
    LEADER_QUARTERS = 1
    ATTENDEE_QUARTERS = 2
    FACULTY_QUARTERS = 3
    OTHER_QUARTERS = 4

    __tablename__ = "quarters"

    name = Column(String(255), nullable=False)
    description = Column(String(255), nullable=False)
    avatar = Column(String(255))
    quarters_type = Column(Integer, nullable=False, default=FACTION_QUARTERS)

    # Relationships
    facility_id = Column(Integer, ForeignKey("facility.id"))
    facility = relationship("Facility", backref="quarters")

    parent_id = Column(Integer, ForeignKey("quarters.id"))
    parent = relationship("Quarters", remote_side=[id], backref="children")
