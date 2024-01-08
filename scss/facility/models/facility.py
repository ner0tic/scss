""" Facility Model. """
from sqlalchemy import Column, Integer, String, ForeignKey
from sqlalchemy.orm import relationship

from ...database import db, BaseMixin, CRUDMixin, AuditMixin, SlugMixin

from .quarters import Quarters

class Facility(BaseMixin, CRUDMixin, AuditMixin, SlugMixin, db.Model):
    """ Facility Model. """
    __tablename__ = "facility"

    id = Column(Integer, primary_key=True)
    name = Column(String(255), nullable=False)
    description = Column(String(255), nullable=False)
    avatar = Column(String(255))

    # Relationships
    # 1:1
    address_id = Column(Integer, ForeignKey("address.id"))
    address = relationship("Address", back_populates="facility")

    organization_id = Column(Integer, ForeignKey("organization.id"))
    organization = relationship("Organization", back_populates="facilities")

    # 1:N
    quarters = relationship("Quarters", lazy=True)
    departments = relationship("Department", lazy=True)

    faculty = relationship("Faculty", backref="facility", lazy=True)

    def get_quarters_by_type(self, quarters_type):
        """ Return list of associated quarters by the given type. """
        return Quarters.query.filter_by(
            f"quarters_type == {quarters_type} and facility_id == {self.id}"
        )
