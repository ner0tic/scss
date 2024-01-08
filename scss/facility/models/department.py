""" Department Model. """
from sqlalchemy import Column, Integer, String, ForeignKey
from sqlalchemy.orm import relationship

from ...database import db, BaseMixin, CRUDMixin, AuditMixin, SlugMixin

class Department(BaseMixin, CRUDMixin, AuditMixin, SlugMixin, db.Model):
    """ Department Model. """
    __tablename__ = "department"

    name = Column(String(255))
    description = Column(String(255), nullable=False)
    avatar = Column(String(255))

    # Relationships
    facility_id = Column(Integer, ForeignKey("facility.id"))
    facility = relationship("Facility", backref="department")

    parent_id = Column(Integer, ForeignKey("department.id"))
    parent = relationship(
        "Department", remote_side=[id], backref="children", overlaps="children"
    )
