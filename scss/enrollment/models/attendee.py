from sqlalchemy import Column, Integer, ForeignKey
from sqlalchemy.orm import relationship

from ...database import db, CRUDMixin, AuditMixin

class AttendeeEnrollment(CRUDMixin, AuditMixin, db.Model):
    """ Attendee Enrollment Model. """
    __tablename__ = "attendee_enrollment"

    id = Column(Integer, primary_key=True)

    attendee_id = Column(Integer, ForeignKey("attendee.user_id"))
    attendee = relationship('Attendee')

    faction_enrollment_id = Column(Integer, ForeignKey("faction_enrollment.id"))
    faction_enrollment = relationship('FactionEnrollment')

    quarters_id = Column(Integer, ForeignKey("quarters.id"))
    quarters = relationship('Quarters')

    attendee_facility_class_enrollments = relationship("AttendeeFacilityClassEnrollment")


class AttendeeFacilityClassEnrollment(CRUDMixin, AuditMixin, db.Model):
    """ Attendee Class Enrollment Model. """
    __tablename__ = "attendee_facility_class_enrollment"

    id = Column(Integer, primary_key=True)

    attendee_enrollment_id = Column(Integer, ForeignKey("attendee_enrollment.id"))
    attendee_enrollment = relationship('AttendeeEnrollment')

    facility_class_id = Column(Integer, ForeignKey("facility_class.id"))
    facility_class = relationship('FacilityClass')