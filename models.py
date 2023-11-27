# models.py
# """Data models."""
from sqlalchemy import Column, DateTime, Integer, String, Text, Boolean, ForeignKey
from sqlalchemy.ext.declarative import declarative_base
from sqlalchemy.sql import func
from sqlalchemy.orm import relationship, backref
#from database import engine

Base = declarative_base()

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
class Faculty(User):
    __tablename__ = "faculty"
    user_id = Column(Integer, ForeignKey('user.id'), primary_key = True)
    user_role = Column(String(255), nullable=False, default="faculty")
    enrollment_id = Column(Integer, ForeignKey('faculty_enrollment.id'))
    facility_id = Column(Integer, ForeignKey('facility.id'))
    
class FacultyEnrollment(Base):
    __tablename__ = "faculty_enrollment"
    id = Column(Integer, primary_key=True, autoincrement="auto")
    faculty_id = Column(Integer, ForeignKey('faculty.user_id'))
    quarters_id = Column(Integer, ForeignKey('quarters.id'))
    temporal_hierarchy_id = Column(Integer, ForeignKey('temporal_hierarchy.id'))
    class_enrollments = relationship("FacultyClassEnrollment", back_populates="faculty_enrollment")
    created_at = Column(DateTime, server_default=func.now())
    updated_at = Column(DateTime, onupdate=func.now())
    
class FacultyClassEnrollment(Base):
    __tablename__ = "faculty_class_enrollment"
    id = Column(Integer, primary_key=True, autoincrement="auto")
    faculty_enrollment_id = Column(Integer, ForeignKey('faculty_enrollment.id'))
    facility_class_id = Column(Integer, ForeignKey('facility_class.id'))
    created_at = Column(DateTime, server_default=func.now())
    updated_at = Column(DateTime, onupdate=func.now())

class Leader(User):
    __tablename__ = "leader"
    user_id = Column(Integer, ForeignKey('user.id'), primary_key = True)
    user_role = Column(String(255), nullable=False, default="leader")
    faction_id = Column(Integer, ForeignKey('faction.id'))
    enrollment_id = Column(Integer, ForeignKey('leader_enrollment.id'))

class LeaderEnrollment(Base):
    __tablename__ = "leader_enrollment"
    id = Column(Integer, primary_key=True, autoincrement="auto")
    leader_id = Column(Integer, ForeignKey('leader.user_id'))
    faction_enrollment_id = Column(Integer, ForeignKey('faction_enrollment.id'))
    quarters_id = Column(Integer, ForeignKey('quarters.id'))
    created_at = Column(DateTime, server_default=func.now())
    updated_at = Column(DateTime, onupdate=func.now())

class Attendee(User):
    __tablename__ = 'attendee'
    user_id = Column(Integer, ForeignKey('user.id'), primary_key = True)
    user_role = Column(String(255), nullable=False, default="attendee")
    faction_id = Column(Integer, ForeignKey('faction.id'))
    enrollment_id = Column(Integer, ForeignKey('attendee_enrollment.id'))
    
class AttendeeEnrollment(Base):
    __tablename__ = "attendee_enrollment"
    id = Column(Integer, primary_key=True, autoincrement="auto")
    attendee_id = Column(Integer, ForeignKey('attendee.user_id'))
    faction_enrollment_id = Column(Integer, ForeignKey('faction_enrollment.id'))
    quarters_id = Column(Integer, ForeignKey('quarters.id'))
    class_enrollments = relationship("AttendeeClassEnrollment", back_populates="attendee_enrollment")
    created_at = Column(DateTime, server_default=func.now())
    updated_at = Column(DateTime, onupdate=func.now())
    
class AttendeeClassEnrollment(Base):
    __tablename__ = "attendee_class_enrollment"
    id = Column(Integer, primary_key=True, autoincrement="auto")
    attendee_enrollment_id = Column(Integer, ForeignKey('attendee_enrollment.id'))
    facility_class_id = Column(Integer, ForeignKey('facility_class.id'))
    created_at = Column(DateTime, server_default=func.now())
    updated_at = Column(DateTime, onupdate=func.now())

class Organization(Base):
    """
    The `Organization` class represents an organization in the system.

    Attributes:
        id (int): The unique identifier of the organization.
        name (str): The name of the organization.
        description (str): The description of the organization.
        avatar_url (str): The URL of the organization's avatar.
        parent_id (int): The ID of the parent organization.
        children (list): The list of child organizations associated with the organization.
        created_at (datetime): The timestamp of when the organization was created.
        updated_at (datetime): The timestamp of when the organization was last updated.

    Examples:
        org = Organization(...)
        print(org.name)  # "Example Organization"
        council = Organization(...)
        council.parent_id(org.id)
        district = Organization(...)
        district.parent_id(council.id)

    """
    __tablename__ = "organization"
    id = Column(Integer, primary_key = True, autoincrement = "auto")
    name = Column(String(255), nullable = False)
    description = Column(String(255), nullable = False)
    avatar_url = Column(String(255))
    parent_id = Column(Integer, ForeignKey('organization.id'))
    children = relationship("organization", backref=backref('parent', remote_side=[id]))
    created_at = Column(DateTime, server_default=func.now())
    updated_at = Column(DateTime, server_default=func.now(), onupdate=func.now())
    deleted_at = Column(DateTime, server_default=func.now())
    
class Faction(Base):
    """
    The `faction` class represents a faction in the system.

    Attributes:
        id (int): The unique identifier of the faction.
        name (str): The name of the faction.
        short_name (str): The short name of the faction.
        description (str): The description of the faction.
        avatar_url (str): The URL of the faction's avatar.
        parent_id (int): The ID of the parent faction.
        children (list): The list of child factions associated with the faction.
        created_at (datetime): The timestamp of when the faction was created.
        updated_at (datetime): The timestamp of when the faction was last updated.
        deleted_at (datetime): The timestamp of when the faction was deleted.
        attendees (list): The list of attendees associated with the faction.
        leaders (list): The list of leaders associated with the faction.
        enrollments: (list) The enrollments associated with the faction.

    Examples:
        fac = faction(...)
        print(fac.name)  # "Example Faction"
    """
    __tablename__ = "faction"
    id = Column(Integer, primary_key = True, autoincrement = "auto")
    name = Column(String(255), nullable = False)
    short_name = Column(String(255), nullable = False)
    description = Column(String(255), nullable = False)
    avatar_url = Column(String(255))
    parent_id = Column(Integer, ForeignKey('faction.id'))
    children = relationship("faction", backref=backref('parent', remote_side=[id]))
    created_at = Column(DateTime, server_default=func.now())
    updated_at = Column(DateTime, server_default=func.now(), onupdate=func.now())
    deleted_at = Column(DateTime, server_default=func.now())
    attendees = relationship("attendee", backref='faction', lazy=True)
    leaders = relationship("leader", backref='faction', lazy=True)
    enrollments = relationship("faction_enrollment", backref='faction', lazy=True)
    
class FactionEnrollment(Base):
    """
    Class representing a faction enrollment.

    Attributes:
        id (int): The unique identifier of the faction enrollment.
        faction_id (int): The ID of the faction associated with the enrollment.
        temporal_hierarchy_id (int): The ID of the temporal hierarchy associated with the enrollment.
        quarters_id (int): The ID of the quarters associated with the enrollment.
        created_at (DateTime): The timestamp of when the enrollment was created.
        updated_at (DateTime): The timestamp of when the enrollment was last updated.

    Examples:
        enrollment = FactionEnrollment()
        enrollment.faction_id = 1
        enrollment.temporal_hierarchy_id = 2
        enrollment.quarters_id = 3
        print(enrollment.id)  # None
    """
        
    __tablename__ = 'faction_enrollment'
    id = Column(Integer, primary_key = True, autoincrement = "auto")
    faction_id = Column(Integer, ForeignKey('faction.id'))
    temporal_hierarchy_id = Column(Integer, ForeignKey('temporal_hierarchy.id'))
    quarters_id = Column(Integer, ForeignKey('quarters.id'))
    created_at = Column(DateTime, server_default=func.now())
    updated_at = Column(DateTime, server_default=func.now(), onupdate=func.now())
    
class TemporalHierarchy(Base):
    """
    The `TemporalHierarchy` class represents a temporal hierarchy in the system.

    Attributes:
        id (int): The unique identifier of the temporal hierarchy.
        name (str): The name of the temporal hierarchy.
        description (str): The description of the temporal hierarchy.
        avatar_url (str): The URL of the temporal hierarchy's avatar.
        start (datetime): The start date and time of the temporal hierarchy.
        end (datetime): The end date and time of the temporal hierarchy.
        organization_id (int): The ID of the organization associated with the temporal hierarchy.
        parent_id (int): The ID of the parent temporal hierarchy.
        children (list): The list of child temporal hierarchies associated with the temporal hierarchy.
        created_at (datetime): The timestamp of when the temporal hierarchy was created.
        updated_at (datetime): The timestamp of when the temporal hierarchy was last updated.
        deleted_at (datetime): The timestamp of when the temporal hierarchy was deleted.

    Examples:
        th = TemporalHierarchy(...)
        print(th.name)  # "Example Temporal Hierarchy"
    """
    __tablename__ = "temporal_hierarchy"
    id = Column(Integer, primary_key = True, autoincrement = "auto")
    name = Column(String(255), nullable = False)
    description = Column(String(255), nullable = False)
    avatar_url = Column(String(255))
    start = Column(DateTime, nullable = False)
    end = Column(DateTime, nullable = False)
    organization_id = Column(Integer, ForeignKey('organization.id'))
    parent_id = Column(Integer, ForeignKey('temporal_hierarchy.id'))
    children = relationship("temporal_hierarchy", backref=backref('parent', remote_side=[id]))
    created_at = Column(DateTime, server_default=func.now())
    updated_at = Column(DateTime, server_default=func.now(), onupdate=func.now())
    deleted_at = Column(DateTime, server_default=func.now())
    
class Facility(Base):
    """
    Represents a facility in the system.

    Attributes:
        id (int): The unique identifier of the facility.
        name (str): The name of the facility.
        description (str): The description of the facility.
        avatar (str): The avatar of the facility.
        address (str): The address of the facility.
        created_at (datetime): The timestamp when the facility was created.
        updated_at (datetime): The timestamp when the facility was last updated.
        quarters (list): The quarters associated with the facility.
        departments (list): The departments associated with the facility.
        faculty (list): The faculty associated with the facility.
    """
    __tablename__ = 'facility'
    id = Column(Integer, primary_key=True, autoincrement="auto")
    name = Column(String(255), nullable=False)
    description = Column(Text)
    avatar = Column(String(255))
    address = Column(String(255)) # @todo: make this a foreign key to an address table
    created_at = Column(DateTime, server_default=func.now())
    updated_at = Column(DateTime, server_default=func.now(), onupdate=func.now())
    quarters = relationship("Quarters", back_populates="facility")
    departments = relationship("Department", back_populates="facility")
    faculty = relationship("Faculty", back_populates="facility")
    
    def __repr__(self):
        """
        Returns a string representation of the Facility object.
        
        The returned string includes the name, description, avatar, address, created_at, and updated_at attributes.
        """
        return f"<Facility(name='{self.name}', description='{self.description}', avatar='{self.avatar}', address='{self.address}', created_at='{self.created_at}', updated_at='{self.updated_at}')>"
    
class Quarters(Base):
    """
    Represents a quarters object.

    Attributes:
        PASSEL_QUARTERS (int): Constant representing passel quarters.
        LEADER_QUARTERS (int): Constant representing leader quarters.
        ATTENDEE_QUARTERS (int): Constant representing attendee quarters.
        FACULTY_QUARTERS (int): Constant representing faculty quarters.
        OTHER_QUARTERS (int): Constant representing other quarters.

    Args:
        name (str): The name of the quarters.
        description (str): The description of the quarters.
        avatar (str): The avatar of the quarters.
        quarters_type (int): The type of the quarters.
        created_at (datetime): The creation date of the quarters.
        updated_at (datetime): The last update date of the quarters.
        facility_id (int): The ID of the facility associated with the quarters.
    """
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
    
    def __repr__(self):
        """
        Returns a string representation of the Quarters object.
        
        The returned string includes the name, description, avatar, quarters_type,
        created_at, and updated_at attributes of the Quarters object.
        """
        return f"<Quarters(name='{self.name}', description='{self.description}', avatar='{self.avatar}', quarters_type='{self.quarters_type}', created_at='{self.created_at}', updated_at='{self.updated_at}')>"
    
class Department(Base):
    __tablename__ = 'department'
    id = Column(Integer, primary_key=True, autoincrement="auto")
    name = Column(String(255))
    description = Column(Text)
    avatar = Column(String(255))
    facility_id = Column(Integer, ForeignKey('facility.id'))
    faculty = relationship("Faculty", back_populates="department")
    parent_id = Column(Integer, ForeignKey('department.id'))
    subdepartments = relationship('Department', backref=backref('parent', remote_side=[id]))

    def __repr__(self):
        return f"<Department(name='{self.name}', description='{self.description}', avatar='{self.avatar}')>"
    
class Requirement(Base):
    __tablename__ = "requirement"
    id = Column(Integer, primary_key=True, autoincrement="auto")
    name = Column(String(255), nullable = False)
    description = Column(Text, nullable = False)
    parent_id = Column(Integer, ForeignKey('requirement.id'))
    children = relationship("requirement", backref=backref('parent', remote_side=[id]))
    organization_id = Column(Integer, ForeignKey('organization.id'))
    optional = Column(Boolean, nullable = False)
    created_at = Column(DateTime, server_default=func.now())
    updated_at = Column(DateTime, server_default=func.now(), onupdate=func.now())
    
class Course(Base):
    __tablename__ = "course"
    id = Column(Integer, primary_key=True, autoincrement="auto")
    name = Column(String(255), nullable = False)
    description = Column(Text, nullable = False)
    prerequisites = relationship("course", backref=backref('requirement', remote_side=[id]))
    requirements = relationship("course", backref=backref('requirement', remote_side=[id]))
    organization_id = Column(Integer, ForeignKey('organization.id'))
    avatar_url = Column(String(255))
    created_at = Column(DateTime, server_default=func.now())
    updated_at = Column(DateTime, server_default=func.now(), onupdate=func.now())
    
class FacilityClass(Base):
    __tablename__ = "facility_class"
    id = Column(Integer, primary_key=True, autoincrement="auto")
    course_id = Column(Integer, ForeignKey('course.id'))
    temporal_hierarchy_id = Column(Integer, ForeignKey('temporal_hierarchy.id'))
    faculty_id = Column(Integer, ForeignKey('faculty.user_id'))
    department_id = Column(Integer, ForeignKey('department.id'))
    capacity = Column(Integer, nullable = False)
    created_at = Column(DateTime, server_default=func.now())
    updated_at = Column(DateTime, server_default=func.now(), onupdate=func.now())
    
class Address(Base):
    __tablename__ = 'address'
    id = Column(Integer, primary_key=True, autoincrement="auto")
    name = Column(String(255), nullable = False)
    street = Column(String(255), nullable = False)
    street2 = Column(String(255))
    city = Column(String(255), nullable = False)
    zone = Column(String(255), nullable = False)
    country = Column(String(255), nullable = False)
    postal_code = Column(String(255), nullable = False)
    phone_number = Column(String(255))