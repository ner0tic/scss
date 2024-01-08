""" Course Enrollment Models. """
from sqlalchemy import Column, Integer, String, ForeignKey
from sqlalchemy.orm import relationship

from ...database import db, CRUDMixin, AuditMixin, SlugMixin


class FacilityClass(CRUDMixin,AuditMixin, SlugMixin, db.Model):
    """ Facility Class Enrollment Model. """
    __tablename__ = "facility_class"

    id = Column(Integer, primary_key=True, autoincrement="auto")
    name = Column(String(255), nullable = False)
    capacity = Column(Integer, nullable = False)

    course_id = Column(Integer, ForeignKey('course.id'))
    course = relationship("Course")

    temporal_hierarchy_id = Column(Integer, ForeignKey('temporal_hierarchy.id'))
    temporal_hierarchy = relationship("TemporalHierarchy")

    faculty_id = Column(Integer, ForeignKey('faculty.user_id'))
    faculty = relationship("Faculty")

    department_id = Column(Integer, ForeignKey('department.id'))
    department = relationship("Department")
