'''Enrollment Related Models'''
import datetime
from ..database import db, CRUDMixin

# Temporal Hierarchy Related Models
class TemporalHierarchy(CRUDMixin, db.Model):
    """ Class: TemporalHierarchy

        A SQLAlchemy model representing a temporal hierarchy.

        Attributes:
            id: The primary key of the temporal hierarchy.
            name: The name of the temporal hierarchy.
            short_name: The short name of the temporal hierarchy.
            description: The description of the temporal hierarchy.
            avatar_url: The URL of the avatar for the temporal hierarchy.
            parent_id: The foreign key referencing the parent temporal hierarchy.
            parent: The relationship to the parent temporal hierarchy.
            children: The relationship to the child temporal hierarchies.
            organization_id: The foreign key referencing the organization.
            start: The start date of the temporal hierarchy.
            end: The end date of the temporal hierarchy.
            created_at: The timestamp indicating the creation time of the temporal hierarchy.
            updated_at: The timestamp indicating the last update time of the temporal hierarchy.
    """

    __tablename__ = 'temporal_hierarchy'
    id = db.Column(db.Integer, primary_key = True, autoincrement = "auto")
    name = db.Column(db.String(255), nullable = False)
    short_name = db.Column(db.String(50))
    description = db.Column(db.String(255), nullable = False)
    avatar_url = db.Column(db.String(255))
    parent_id = db.Column(db.Integer, db.ForeignKey('temporal_hierarchy.id'))
    parent = db.relationship("TemporalHierarchy", remote_side=[id], backref="children", overlaps="childrenS")
#    children = db.relationship('TemporalHierarchy', remote_side=[parent_id], backref="parent") # , overlaps="parent", uselist=True)
    organization_id = db.Column(db.Integer, db.ForeignKey('organization.id'))
    start = db.Column(db.DateTime(timezone=True), nullable = False)
    end = db.Column(db.DateTime(timezone=True), nullable = False)
    created_at = db.Column(
        db.DateTime(timezone=True),
        default=datetime.datetime.utcnow
    )
    updated_at = db.Column(
        db.DateTime(timezone=True),
        default=datetime.datetime.utcnow
    )
class FacilityEnrollment(TemporalHierarchy):
    id = db.Column(db.Integer, db.ForeignKey('temporal_hierarchy.id'), primary_key = True)
    facility_id = db.Column(db.Integer, db.ForeignKey('facility.id'))
    name = db.Column(db.String(255), nullable = False)
    
    def __init__(self, *args, **kwargs):
        super(FacilityEnrollment, self).__init__(*args, **kwargs)
        self.name = kwargs.get('name', None)
        self.facility_id = kwargs.get('facility_id', None)
    
# Enrollment Related Models


class FacultyEnrollment(CRUDMixin, db.Model):
    __tablename__ = "faculty_enrollment"
    id = db.Column(db.Integer, primary_key=True, autoincrement="auto")
    faculty_id = db.Column(db.Integer, db.ForeignKey('faculty.user_id'))
    quarters_id = db.Column(db.Integer, db.ForeignKey('quarters.id'))
    temporal_hierarchy_id = db.Column(db.Integer, db.ForeignKey('temporal_hierarchy.id'))
#    temporal_hierarchy = relationship("TemporalHierarchy", backref="faculty_enrollment")
    class_enrollments = db.relationship("FacultyClassEnrollment", backref="faculty_enrollment")
    created_at = db.Column(
        db.DateTime(timezone=True),
        default=datetime.datetime.utcnow
    )
    updated_at = db.Column(
        db.DateTime(timezone=True),
        default=datetime.datetime.utcnow
    )

class FacultyClassEnrollment(CRUDMixin, db.Model):
    __tablename__ = "faculty_class_enrollment"
    id = db.Column(db.Integer, primary_key=True, autoincrement="auto")
    faculty_enrollment_id = db.Column(db.Integer, db.ForeignKey('faculty_enrollment.id'))
    facility_class_id = db.Column(db.Integer, db.ForeignKey('facility_class.id'))
    created_at = db.Column(
        db.DateTime(timezone=True),
        default=datetime.datetime.utcnow
    )
    updated_at = db.Column(
        db.DateTime(timezone=True),
        default=datetime.datetime.utcnow
    )

class FacilityClass(CRUDMixin, db.Model):
    __tablename__ = "facility_class"
    id = db.Column(db.Integer, primary_key=True, autoincrement="auto")
    name = db.Column(db.String(255), nullable = False)
    course_id = db.Column(db.Integer, db.ForeignKey('course.id'))
    temporal_hierarchy_id = db.Column(db.Integer, db.ForeignKey('temporal_hierarchy.id'))
    faculty_id = db.Column(db.Integer, db.ForeignKey('faculty.user_id'))
    department_id = db.Column(db.Integer, db.ForeignKey('department.id'))
    capacity = db.Column(db.Integer, nullable = False)
    created_at = db.Column(
        db.DateTime(timezone=True),
        default=datetime.datetime.utcnow
    )
    updated_at = db.Column(
        db.DateTime(timezone=True),
        default=datetime.datetime.utcnow
    )


