""" Leader Enrollment Models. """
from sqlalchemy import Column, Integer, ForeignKey
from sqlalchemy.orm import relationship

from ...database import db, CRUDMixin, AuditMixin


class LeaderEnrollment(CRUDMixin, AuditMixin, db.Model):
    """ Leader Enrollment Model. """
    __tablename__ = "attendee_enrollment"

    id = Column(Integer, primary_key=True)

    leader_id = Column(Integer, ForeignKey("leader.user_id"))
    leader = relationship("Leader")

    faction_enrollment_id = Column(Integer, ForeignKey("faction_enrollment.id"))
    faction_enrollment = relationship("FactionEnrollment")

    quarters_id = Column(Integer, ForeignKey("quarters.id"))
    quarters = relationship("Quarters")
