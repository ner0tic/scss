""" Address Related Models."""
from sqlalchemy import Column, String, Integer, ForeignKey
from sqlalchemy.orm import relationship
from ..database import db, BaseMixin, CRUDMixin, AuditMixin

class Address(BaseMixin, CRUDMixin, AuditMixin, db.Model):
    """ Class representing an Address. """
    __tablename__ = "address"

    name = Column(String(255))
    line1 = Column(String(255), nullable=False)
    line2 = Column(String(255))
    city = Column(String(255), nullable=False)
    state = Column(String(255), nullable=False)
    postal_code = Column(String(255), nullable=False)
    country = Column(String(255), nullable=False)

    organization = relationship('Organization', back_populates="address")
    faction = relationship('Faction', back_populates="address")
    facility = relationship('Facility', back_populates="address")
    user_id = Column(Integer, ForeignKey('user.id'))
    user = relationship('User', back_populates="address", primaryjoin="Address.user_id == User.id")


    def __str__(self):
        return self.name
