""" Faculty Enrollment Models. """
from sqlalchemy import Column, Integer, ForeignKey
from sqlalchemy.orm import relationship

from ...database import db, CRUDMixin, AuditMixin

class FacultyEnrollment(CRUDMixin, AuditMixin, db.Model):
    """ Faculty Enrollment Model. """
    __tablename__ = "faculty_enrollment"

    id = Column(Integer, primary_key=True)

    faculty_id = Column(Integer, ForeignKey('faculty.user_id'))
    faculty = relationship("Faculty", backref="faculty")

    quarters_id = Column(Integer, ForeignKey('quarters.id'))
    quarters = relationship("Quarters", backref="quarters")

    temporal_hierarchy_id = Column(Integer, ForeignKey('temporal_hierarchy.id'))
    temporal_hierarchy = relationship("TemporalHierarchy", backref="faculty_enrollment")

    class_enrollments = relationship("FacultyClassEnrollment", backref="faculty_enrollment")


class FacultyClassEnrollment(CRUDMixin, AuditMixin, db.Model):
    """ Faculty Class Enrollment Model. """
    __tablename__ = "faculty_class_enrollment"

    id = Column(Integer, primary_key=True, autoincrement="auto")

    faculty_enrollment_id = Column(Integer, ForeignKey('faculty_enrollment.id'))
    faculty_enrollment = relationship("FacultyEnrollment")

    facility_class_id = Column(Integer, ForeignKey('facility_class.id'))
    facility_class = relationship("FacilityClass")
