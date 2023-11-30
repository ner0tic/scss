from sqlalchemy import Column, DateTime, Integer, String, Boolean, Text, ForeignKey
from sqlalchemy.orm import DeclarativeBase, relationship
from sqlalchemy.sql import func
# from scss.models import Base

class Base(DeclarativeBase):
    pass

class User(Base):
    """User account."""

    __tablename__ = "user"

    id = Column(Integer, primary_key=True, autoincrement="auto")
    username = Column(String(255), unique=True, nullable=False)
    password = Column(Text, nullable=False)
    email = Column(String(255), unique=True, nullable=False)
    first_name = Column(String(255))
    last_name = Column(String(255))
    address_id = Column(Integer, ForeignKey('address.id'))
    avatar_url = Column(Text)
    role = Column(String(255))
    last_seen = Column(DateTime)
    created_at = Column(DateTime, server_default=func.now())
    updated_at = Column(DateTime, onupdate=func.now())

    def __repr__(self):
        return f"<User id={self.id}, username={self.username}, email={self.email}>"
    
class Admin(User):
    __tablename__ = "admin"
    user_id = Column(Integer, ForeignKey('user.id'), primary_key = True)
    user_role = Column(String(255), nullable=False, default="admin")
    organization_id = Column(Integer, ForeignKey('organization.id'))
    organization = relationship("Organization", backref="admins")

class Address(Base):
    __tablename__ = "address"
    id = Column(Integer, primary_key=True, autoincrement="auto")
    name = Column(String(255))
    line1 = Column(String(255), nullable=False)
    line2 = Column(String(255))
    city = Column(String(255), nullable=False)
    state = Column(String(255), nullable=False)
    postal_code = Column(String(255), nullable=False)
    country = Column(String(255), nullable=False)
    created_at = Column(DateTime, server_default=func.now())
    updated_at = Column(DateTime, onupdate=func.now())
    
    def __repr__(self):
        return f"<Address(line1='{self.line1}', line2='{self.line2}', city='{self.city}', state='{self.state}', postal_code='{self.postal_code}', country='{self.country}', created_at='{self.created_at}', updated_at='{self.updated_at}')>"

# Organization Related Models.
class Organization(Base):
    """
    Represents an organization.

    Attributes:
        id (int): The unique identifier of the organization.
        name (str): The name of the organization.
        short_name (str): The short name of the organization.
        description (str): The description of the organization.
        avatar_url (str): The URL of the organization's avatar.
        councils (list): The list of councils associated with the organization.
        created_at (datetime): The timestamp when the organization was created.
        updated_at (datetime): The timestamp when the organization was last updated.
    """
    __tablename__ = "organization"
    id = Column(Integer, primary_key=True, autoincrement="auto")
    name = Column(String(255), nullable=False)
    short_name = Column(String(50))
    description = Column(String(255), nullable=False)
    avatar_url = Column(String(255))
    parent_id = Column(Integer, ForeignKey('organization.id'))
    parent = relationship("Organization", remote_side=[id], backref="children", overlaps="children")
#     children = relationship('Organization', remote_side=[parent_id], backref="parent", overlaps="parent", uselist=True)
    # councils = relationship("Council", backref="organization.id")
    factions = relationship("Faction", backref="organization", lazy=True)
    created_at = Column(DateTime, server_default=func.now())
    updated_at = Column(DateTime, server_default=func.now(), onupdate=func.now())
    
    def __repr__(self):
        return f"{self.__class__.__name__}({self.name!r})"
    
# Council Related Models.
# class Council(Base):
#     """
#     Represents a council in the organization.

#     Attributes:
#         id (int): The unique identifier of the council.
#         name (str): The name of the council.
#         short_name (str): The short name of the council.
#         description (str): The description of the council.
#         avatar_url (str): The URL of the council's avatar.
#         organization_id (int): The ID of the organization the council belongs to.
#         districts (list): The districts associated with the council.
#         created_at (datetime): The date and time when the council was created.
#         updated_at (datetime): The date and time when the council was last updated.
#     """
#     __tablename__ = "council"
#     id = Column(Integer, primary_key=True, autoincrement="auto")
#     name = Column(String(255), nullable=False)
#     short_name = Column(String(50))
#     description = Column(String(255), nullable=False)
#     avatar_url = Column(String(255))
#     organization_id = Column(Integer, ForeignKey('organization.id'))
#     districts = relationship("District", backref="council.id")
#     created_at = Column(DateTime, server_default=func.now())
#     updated_at = Column(DateTime, server_default=func.now(), onupdate=func.now())

# # District Related Models.
# class District(Base):
#     """
#     Represents a district in the organization.
#     Attributes:
#         id (int): The unique identifier of the district.
#         name (str): The name of the district.
#         short_name (str): The short name of the district.
#         description (str): The description of the district.
#         avatar_url (str): The URL of the district's avatar.
#         council_id (int): The ID of the council the district belongs to.
#         districts (list): The districts associated with the district.
#         created_at (datetime): The date and time when the district was created.
#         updated_at (datetime): The date and time when the district was last updated.
#     """
#     __tablename__ = "district"
#     id = Column(Integer, primary_key=True, autoincrement="auto")
#     name = Column(String(255), nullable=False)
#     short_name = Column(String(50))
#     description = Column(String(255), nullable=False)
#     avatar_url = Column(String(255))
#     council_id = Column(Integer, ForeignKey('council.id'))
#     council = relationship("Council", backref="council.id")
#     factions = relationship("Faction")#, backref="district.id", lazy=True) # back_populates="factions")
#     facilities = relationship("Facility", backref="District.id", lazy=True)
#     faculty = relationship("Faculty", backref="District.id", lazy=True)    
#     created_at = Column(DateTime, server_default=func.now())
#     updated_at = Column(DateTime, server_default=func.now(), onupdate=func.now())
    
# Faction Related Models
class Faction(Base):
    __tablename__ = "faction"
    id = Column(Integer, primary_key = True, autoincrement = "auto")
    name = Column(String(255), nullable = False)
    short_name = Column(String(255), nullable = False)
    description = Column(String(255), nullable = False)
    avatar_url = Column(String(255))
    organization_id = Column(Integer, ForeignKey('organization.id'))
#    organization = relationship("Faction", backref='factions', lazy=True)
    patrols = relationship("Patrol", backref='parent', remote_side=[id])
    attendees = relationship("Attendee", backref='faction', lazy=True)
    leaders = relationship("Leader", backref='faction', lazy=True)
    enrollments = relationship("FactionEnrollment", backref='faction', lazy=True)
    created_at = Column(DateTime, server_default=func.now())
    updated_at = Column(DateTime, server_default=func.now(), onupdate=func.now())
    
# Patrol Related Models
class Patrol(Base):
    __tablename__ = "patrol"
    id = Column(Integer, primary_key = True, autoincrement = "auto")
    name = Column(String(255), nullable = False)
    description = Column(String(255), nullable = False)
    avatar_url = Column(String(255))
    faction_id = Column(Integer, ForeignKey('faction.id'))
    attendees = relationship("Attendee", backref='patrol', lazy=True)
    created_at = Column(DateTime, server_default=func.now())
    updated_at = Column(DateTime, server_default=func.now(), onupdate=func.now())
    
# Attendee Related Models
class Attendee(User):
    __tablename__ = 'attendee'
    user_id = Column(Integer, ForeignKey('user.id'), primary_key = True)
    user_role = Column(String(255), nullable=False, default="attendee")
    faction_id = Column(Integer, ForeignKey('faction.id'))
#     faction = relationship("Faction", backref='attendees', lazy=True)
    patrol_id = Column(Integer, ForeignKey('patrol.id'))
#    patrol = relationship("Patrol", backref='attendees', lazy=True)
    enrollment_id = Column(Integer, ForeignKey('attendee_enrollment.id'))
    
# Leader Related Models
class Leader(User):
    __tablename__ = "leader"
    user_id = Column(Integer, ForeignKey('user.id'), primary_key = True)
    user_role = Column(String(255), nullable=False, default="leader")
    faction_id = Column(Integer, ForeignKey('faction.id'))
#    faction = relationship("Faction", backref='leaders', lazy=True)
    enrollment_id = Column(Integer, ForeignKey('leader_enrollment.id'))

# Facility Related Models
class Facility(Base):
    __tablename__ = 'facility'
    id = Column(Integer, primary_key=True, autoincrement="auto")
    name = Column(String(255), nullable=False)
    description = Column(Text)
    avatar = Column(String(255))
    address_id = Column(Integer, ForeignKey('address.id'))
#    address = relationship("Address", backref="facility")
    quarters = relationship("Quarters", backref="facility")
    departments = relationship("Department", backref="facility")
    faculty = relationship("Faculty", backref="facility")
    created_at = Column(DateTime, server_default=func.now())
    updated_at = Column(DateTime, server_default=func.now(), onupdate=func.now())
    
    def __repr__(self):
        return f"<Facility(name='{self.name}', description='{self.description}', avatar='{self.avatar}', address='{self.address}', created_at='{self.created_at}', updated_at='{self.updated_at}')>"

# Faculty Related Models
class Faculty(User):
    __tablename__ = "faculty"
    user_id = Column(Integer, ForeignKey('user.id'), primary_key = True)
    user_role = Column(String(255), nullable=False, default="faculty")
    enrollment_id = Column(Integer, ForeignKey('faculty_enrollment.id'))
#    enrollmemnt = relationship("FacultyEnrollment", backref="faculty")
    facility_id = Column(Integer, ForeignKey('facility.id'))
#    facility = relationship("Facility", backref="faculty")
    department_id = Column(Integer, ForeignKey('department.id'))
    
    def __repr__(self):
        return f"<Faculty(user_id='{self.user_id}', user_role='{self.user_role}', enrollment_id='{self.enrollment_id}', facility_id='{self.facility_id}')>"

# Quarters Related Models
class Quarters(Base):
    PASSEL_QUARTERS = 0
    LEADER_QUARTERS = 1
    ATTENDEE_QUARTERS = 2
    FACULTY_QUARTERS = 3
    OTHER_QUARTERS = 4
    
    __tablename__ = 'quarters'
    id = Column(Integer, primary_key=True, autoincrement="auto")
    name = Column(String(255), nullable=False)
    description = Column(Text)
    avatar = Column(String(255))
    quarters_type = Column(Integer, nullable=False, default=PASSEL_QUARTERS)  
    created_at = Column(DateTime, server_default=func.now())
    updated_at = Column(DateTime, server_default=func.now(), onupdate=func.now())
    facility_id = Column(Integer, ForeignKey('facility.id'))
 #   facility = relationship("Facility", backref="quarters")
    parent_id = Column(Integer, ForeignKey('quarters.id'))
    parent = relationship("Quarters", remote_side=[id], backref="children") # , overlaps="children")
#    children = relationship('Quarters', remote_side=[parent_id], backref="parent") # , overlaps="parent", uselist=True)
    
    def __repr__(self):
        return f"<Quarters(name='{self.name}', description='{self.description}', avatar='{self.avatar}', quarters_type='{self.quarters_type}', created_at='{self.created_at}', updated_at='{self.updated_at}')>"

# Department Related Models
class Department(Base):
    __tablename__ = 'department'
    id = Column(Integer, primary_key=True, autoincrement="auto")
    name = Column(String(255))
    description = Column(Text)
    avatar = Column(String(255))
    facility_id = Column(Integer, ForeignKey('facility.id'))
#    facility = relationship("Facility", backref="department")
    faculty = relationship("Faculty", backref="department")
    parent_id = Column(Integer, ForeignKey('department.id'))
    parent = relationship("Department", remote_side=[id], backref="children", overlaps="children")
#    children = relationship('Department', backref='parent', remote_side=[id])

    def __repr__(self):
        return f"<Department(name='{self.name}', description='{self.description}', avatar='{self.avatar}')>"

# Temporal Hierarchy Related Models
class TemporalHierarchy(Base):
    __tablename__ = 'temporal_hierarchy'
    id = Column(Integer, primary_key = True, autoincrement = "auto")
    name = Column(String(255), nullable = False)
    short_name = Column(String(50))
    description = Column(String(255), nullable = False)
    avatar_url = Column(String(255))
    parent_id = Column(Integer, ForeignKey('temporal_hierarchy.id'))
#    parent = relationship("TemporalHierarchy", remote_side=[id], backref="children") # , overlaps="children")
#    children = relationship('TemporalHierarchy', remote_side=[parent_id], backref="parent") # , overlaps="parent", uselist=True)
    organization_id = Column(Integer, ForeignKey('organization.id'))
#    organization = relationship("Organization", backref="temporal_hierarchy")   
    created_at = Column(DateTime, server_default=func.now())
    updated_at = Column(DateTime, server_default=func.now(), onupdate=func.now())
# class Season(Base):
#     id = Column(Integer, primary_key = True, autoincrement = "auto")
#     name = Column(String(255), nullable = False)
#     short_name = Column(String(50))
#     description = Column(String(255), nullable = False)
#     avatar_url = Column(String(255))
#     start = Column(DateTime)
#     end = Column(DateTime)
#     organization_id = Column(Integer, ForeignKey('organization.id'))
#     created_at = Column(DateTime, server_default=func.now())
#     updated_at = Column(DateTime, server_default=func.now(), onupdate=func.now())
    
# class FacilityWeekEnrollment(Base):
#     id = Column(Integer, primary_key = True, autoincrement = "auto")
#     name = Column(String(255), nullable = False)
#     short_name = Column(String(50))
#     description = Column(String(255), nullable = False)
#     avatar_url = Column(String(255))
#     start = Column(DateTime)
#     end = Column(DateTime)
#     facility_id = Column(Integer, ForeignKey('facility.id'))
    
#     created_at = Column(DateTime, server_default=func.now())
#     updated_at = Column(DateTime, server_default=func.now(), onupdate=func.now())    
    
# class FacilityPeriodEnrollment(Base):
#     id = Column(Integer, primary_key = True, autoincrement = "auto")
#     name = Column(String(255), nullable = False)
#     short_name = Column(String(50))
#     description = Column(String(255), nullable = False)
#     avatar_url = Column(String(255))
#     start = Column(DateTime)
#     end = Column(DateTime)
#     facility_week_enrollment_id = Column(Integer, ForeignKey('facility_week.id'))
#     facility_classes = relationship("FacilityClass", backref='facility_period', lazy=True)
#     created_at = Column(DateTime, server_default=func.now())
#     updated_at = Column(DateTime, server_default=func.now(), onupdate=func.now())
    
# Enrollment Related Models
class FactionEnrollment(Base):
    __tablename__ = 'faction_enrollment'
    id = Column(Integer, primary_key = True, autoincrement = "auto")
    faction_id = Column(Integer, ForeignKey('faction.id'))
#    faction = relationship("Faction", backref="faction_enrollment")
    temporal_hierarchy_id = Column(Integer, ForeignKey('temporal_hierarchy.id'))
#    temporal_hierarchy = relationship("TemporalHierarchy", backref="faction_enrollment")
#     season_id = Column(Integer, ForeignKey('season.id'))
    quarters_id = Column(Integer, ForeignKey('quarters.id'))
#    quarters = relationship("Quarters", backref="faction_enrollment")
    created_at = Column(DateTime, server_default=func.now())
    updated_at = Column(DateTime, server_default=func.now(), onupdate=func.now())

class FacultyEnrollment(Base):
    __tablename__ = "faculty_enrollment"
    id = Column(Integer, primary_key=True, autoincrement="auto")
    faculty_id = Column(Integer, ForeignKey('faculty.user_id'))
#    faculty = relationship("Faculty", backref="faculty_enrollment")
    quarters_id = Column(Integer, ForeignKey('quarters.id'))
#    quarters = relationship("Quarters", backref="faculty_enrollment")
    # season_id = Column(Integer, ForeignKey('season.id'))
    temporal_hierarchy_id = Column(Integer, ForeignKey('temporal_hierarchy.id'))
#    temporal_hierarchy = relationship("TemporalHierarchy", backref="faculty_enrollment")
    class_enrollments = relationship("FacultyClassEnrollment", backref="faculty_enrollment")
    created_at = Column(DateTime, server_default=func.now())
    updated_at = Column(DateTime, onupdate=func.now())
    
class FacultyClassEnrollment(Base):
    __tablename__ = "faculty_class_enrollment"
    id = Column(Integer, primary_key=True, autoincrement="auto")
    faculty_enrollment_id = Column(Integer, ForeignKey('faculty_enrollment.id'))
#    faculty_enrollment = relationship("FacultyEnrollment", backref="faculty_class_enrollment")
    facility_class_id = Column(Integer, ForeignKey('facility_class.id'))
#    facility_class = relationship("FacilityClass", backref="faculty_class_enrollment")
    created_at = Column(DateTime, server_default=func.now())
    updated_at = Column(DateTime, onupdate=func.now())

class FacilityClass(Base):
    __tablename__ = "facility_class"
    id = Column(Integer, primary_key=True, autoincrement="auto")
    name = Column(String(255), nullable = False)
    course_id = Column(Integer, ForeignKey('course.id'))
#    course = relationship("Course", backref="facility_class")
#     facility_period_enrollment_id = Column(Integer, ForeignKey('facility_period_enrollment.id'))
#     facility_period_enrollment = relationship("FacilityPeriodEnrollment", backref="facility_class")
    temporal_hierarchy_id = Column(Integer, ForeignKey('temporal_hierarchy.id'))
#    temporal_hierarchy = relationship("TemporalHierarchy", backref="facility_class")
    faculty_id = Column(Integer, ForeignKey('faculty.user_id'))
#    faculty = relationship("Faculty", backref="facility_class")
    department_id = Column(Integer, ForeignKey('department.id'))
#    department = relationship("Department", backref="facility_class")
    capacity = Column(Integer, nullable = False)
    created_at = Column(DateTime, server_default=func.now())
    updated_at = Column(DateTime, server_default=func.now(), onupdate=func.now())


class LeaderEnrollment(Base):
    __tablename__ = "leader_enrollment"
    id = Column(Integer, primary_key=True, autoincrement="auto")
    leader_id = Column(Integer, ForeignKey('leader.user_id'))
#    leader = relationship("Leader", backref="leader_enrollment")
    faction_enrollment_id = Column(Integer, ForeignKey('faction_enrollment.id'))
#    faction_enrollment = relationship("FactionEnrollment", backref="leader_enrollment")
    quarters_id = Column(Integer, ForeignKey('quarters.id'))
#    quarters = relationship("Quarters", backref="leader_enrollment")
    created_at = Column(DateTime, server_default=func.now())
    updated_at = Column(DateTime, onupdate=func.now())

class AttendeeEnrollment(Base):
    __tablename__ = "attendee_enrollment"
    id = Column(Integer, primary_key=True, autoincrement="auto")
    attendee_id = Column(Integer, ForeignKey('attendee.user_id'))
#    attendee = relationship("Attendee", backref="attendee_enrollment")
    faction_enrollment_id = Column(Integer, ForeignKey('faction_enrollment.id'))
#    faction_enrollment = relationship("FactionEnrollment", backref="attendee_enrollment")
    quarters_id = Column(Integer, ForeignKey('quarters.id'))
#    quarters = relationship("Quarters", backref="attendee_enrollment")
    class_enrollments = relationship("AttendeeClassEnrollment", backref="attendee_enrollment")
    created_at = Column(DateTime, server_default=func.now())
    updated_at = Column(DateTime, onupdate=func.now())
    
class AttendeeClassEnrollment(Base):
    __tablename__ = "attendee_class_enrollment"
    id = Column(Integer, primary_key=True, autoincrement="auto")
    attendee_enrollment_id = Column(Integer, ForeignKey('attendee_enrollment.id'))
#    attendee_enrollment = relationship("AttendeeEnrollment", backref="attendee_class_enrollment")
    facility_class_id = Column(Integer, ForeignKey('facility_class.id'))
#    facility_class = relationship("FacilityClass", backref="attendee_class_enrollment")
    created_at = Column(DateTime, server_default=func.now())
    updated_at = Column(DateTime, onupdate=func.now())

class Requirement(Base):
    __tablename__ = "requirement"
    id = Column(Integer, primary_key=True, autoincrement="auto")
    name = Column(String(255), nullable = False)
    description = Column(Text, nullable = False)
    parent_id = Column(Integer, ForeignKey('requirement.id'))
#    parent = relationship("Requirement", backref='requirement', remote_side=[id])
#    children = relationship("Requirement", backref='parent', remote_side=[id])
    organization_id = Column(Integer, ForeignKey('organization.id'))
#    organization = relationship("Organization", backref="requirements")
    optional = Column(Boolean, nullable = False)
    course_id = Column(Integer, ForeignKey('course.id'))
#    course = relationship("Course", backref="requirements")
    created_at = Column(DateTime, server_default=func.now())
    updated_at = Column(DateTime, server_default=func.now(), onupdate=func.now())
    
class Course(Base):
    __tablename__ = "course"
    id = Column(Integer, primary_key=True, autoincrement="auto")
    name = Column(String(255), nullable = False)
    description = Column(Text, nullable = False)
    avatar_url = Column(String(255))
#    prerequisites = relationship("Course", backref='requirement', remote_side=[id])
#    requirements = relationship("Course", backref='requirement', remote_side=[id])
    organization_id = Column(Integer, ForeignKey('organization.id'))
#    organization = relationship("Organization", backref="courses")
    created_at = Column(DateTime, server_default=func.now())
    updated_at = Column(DateTime, server_default=func.now(), onupdate=func.now())
    