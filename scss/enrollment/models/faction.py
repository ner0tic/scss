""" Faction Enrollment Models. """
from sqlalchemy import Column, Integer, ForeignKey
from sqlalchemy.orm import relationship

from ...database import db, CRUDMixin, AuditMixin, BaseMixin


class FactionEnrollment(BaseMixin, CRUDMixin, AuditMixin, db.Model):
    """ Faction Enrollment Model. """
    __tablename__ = "faction_enrollment"

    id = Column(Integer, primary_key=True, autoincrement="auto")

    faction_id = Column(Integer, ForeignKey("faction.id"))
    faction = relationship('Faction')

    facility_enrollment_id = Column(Integer, ForeignKey("facility_enrollment.id"))
    facility_enrollment = relationship('FacilityEnrollment')

    quarters_id = Column(Integer, ForeignKey("quarters.id"))
    quarters = relationship('Quarters')
