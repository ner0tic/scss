""" Address Related Models."""
from sqlalchemy import Column, String
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

    def __str__(self):
        return self.name
