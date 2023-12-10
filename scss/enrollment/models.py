'''Enrollment Related Models'''
import datetime
from scss.database import db, CRUDMixin

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
    parent = db.relationship("TemporalHierarchy", remote_side=[id], backref="children") # , overlaps="children")
    children = db.relationship('TemporalHierarchy', remote_side=[parent_id], backref="parent") # , overlaps="parent", uselist=True)
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

# Enrollment Related Models
class FactionEnrollment(CRUDMixin, db.Model):
    __tablename__ = 'faction_enrollment'
    id = db.Column(db.Integer, primary_key = True, autoincrement = "auto")
    faction_id = db.Column(db.Integer, db.ForeignKey('faction.id'))
    temporal_hierarchy_id = db.Column(db.Integer, db.ForeignKey('temporal_hierarchy.id'))
    quarters_id = db.Column(db.Integer, db.ForeignKey('quarters.id'))
    created_at = db.Column(
        db.DateTime(timezone=True),
        default=datetime.datetime.utcnow
    )
    updated_at = db.Column(
        db.DateTime(timezone=True),
        default=datetime.datetime.utcnow
    )

class FacultyEnrollment(CRUDMixin, db.Model):
    __tablename__ = "faculty_enrollment"
    id = db.Column(db.Integer, primary_key=True, autoincrement="auto")
    faculty_id = db.Column(Integer, db.ForeignKey('faculty.user_id'))
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

class LeaderEnrollment(CRUDMixin, db.Model):
    __tablename__ = "leader_enrollment"
    id = db.Column(db.Integer, primary_key=True, autoincrement="auto")
    leader_id = db.Column(db.Integer, db.ForeignKey('leader.user_id'))
    faction_enrollment_id = db.Column(db.Integer, db.ForeignKey('faction_enrollment.id'))
    quarters_id = db.Column(db.Integer, db.ForeignKey('quarters.id'))
    created_at = db.Column(
        db.DateTime(timezone=True),
        default=datetime.datetime.utcnow
    )
    updated_at = db.Column(
        db.DateTime(timezone=True),
        default=datetime.datetime.utcnow
    )

class AttendeeEnrollment(CRUDMixin, db.Model):
    __tablename__ = "attendee_enrollment"
    id = db.Column(db.Integer, primary_key=True, autoincrement="auto")
    attendee_id = db.Column(db.Integer, db.ForeignKey('attendee.user_id'))
    faction_enrollment_id = db.Column(db.Integer, db.ForeignKey('faction_enrollment.id'))
    quarters_id = db.Column(db.Integer, db.ForeignKey('quarters.id'))
    class_enrollments = db.relationship("AttendeeClassEnrollment", backref="attendee_enrollment")
    created_at = db.Column(
        db.DateTime(timezone=True),
        default=datetime.datetime.utcnow
    )
    updated_at = db.Column(
        db.DateTime(timezone=True),
        default=datetime.datetime.utcnow
    )

class AttendeeClassEnrollment(CRUDMixin, db.Model):
    __tablename__ = "attendee_class_enrollment"
    id = db.Column(db.Integer, primary_key=True, autoincrement="auto")
    attendee_enrollment_id = db.Column(db.Integer, db.ForeignKey('attendee_enrollment.id'))
    facility_class_id = db.Column(db.Integer, db.ForeignKey('facility_class.id'))
    created_at = db.Column(
        db.DateTime(timezone=True),
        default=datetime.datetime.utcnow
    )
    updated_at = db.Column(
        db.DateTime(timezone=True),
        default=datetime.datetime.utcnow
    )
