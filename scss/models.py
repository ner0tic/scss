# scss/models.py
# """Data models."""
from sqlalchemy import Column, DateTime, Integer, String, Text, ForeignKey, relationship
from sqlalchemy.ext.declarative import declarative_base
from sqlalchemy.sql import func
from database import engine

Base = declarative_base()

class Passel(Base):
    """
    The `Passel` class represents a group of individuals with common interests or goals.

    Attributes:
        id (int): The unique identifier of the passel.
        name (str): The name of the passel.
        description (str): The description of the passel.
        short_name (str): The short name of the passel.
        address (str): The address of the passel.
        avatar (str): The avatar of the passel.
        created_at (datetime): The timestamp when the passel was created.
        updated_at (datetime): The timestamp when the passel was last updated.
        factions (list): The list of factions associated with the passel.
        attendees (list): The list of attendees associated with the passel.
        leaders (list): The list of leaders associated with the passel.
        enrollments (list): The list of enrollments associated with the passel.

    Methods:
        __repr__(): Returns a string representation of the `Passel` object.
    """
    __tablename__ = 'passel'
    id = Column(Integer, primary_key=True, autoincrement="auto")
    name = Column(String(255), nullable=False)
    description = Column(Text)
    short_name = Column(String(20))
    address = Column(String(255)) # @todo: make this a foreign key to an address table
    avatar = Column(String(255))
    created_at = Column(DateTime, server_default=func.now())
    updated_at = Column(DateTime, server_default=func.now(), onupdate=func.now())
    factions = relationship("Faction", back_populates="passel")
    attendees = relationship("Attendee", back_populates="passel")
    leaders = relationship("Leader", back_populates="passel")
    enrollments = relationship("PasselEnrollment", back_populates="passel")
    
    def __repr__(self):
        """
        Returns a string representation of the object.
        
        The returned string includes the values of the object's attributes.
        """
        return f"<Passel(name='{self.name}', description='{self.description}', short_name='{self.short_name}', address='{self.address}', avatar='{self.avatar}', created_at='{self.created_at}', updated_at='{self.updated_at}')>"
        
class Faction(Base):
    """
    The `Faction` class represents a faction in the system.

    Attributes:
        id (int): The unique identifier of the faction.
        name (str): The name of the faction.
        description (str): The description of the faction.
        avatar (str): The avatar of the faction.
        created_at (datetime): The timestamp when the faction was created.
        updated_at (datetime): The timestamp when the faction was last updated.
        passel_id (int): The ID of the associated passel.
        passel (Passel): The associated passel object.
        attendees (List[Attendee]): The list of attendees belonging to the faction.
    """

    __tablename__ = 'faction'
    id = Column(Integer, primary_key=True, autoincrement="auto")
    name = Column(String(255), nullable=False)
    description = Column(Text)
    avatar = Column(String(255))
    created_at = Column(DateTime, server_default=func.now())
    updated_at = Column(DateTime, server_default=func.now(), onupdate=func.now())
    passel_id = Column(Integer, ForeignKey('passel.id'))
    passel = relationship("Passel", back_populates="factions")
    attendees = relationship("Attendee", back_populates="faction")

    def __repr__(self):
        """
        Returns a string representation of the Faction object.
        
        The returned string includes the name, description, avatar, created_at, and updated_at attributes.
        """
        return f"<Faction(name='{self.name}', description='{self.description}', avatar='{self.avatar}', created_at='{self.created_at}', updated_at='{self.updated_at}')>"
    
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
    
class PasselQuarters(Quarters):
    """
    A class representing Passel Quarters.
    
    This class inherits from the Quarters class and represents a specific type of quarters called Passel Quarters.
    Passel Quarters have a name, description, avatar, quarters type, creation date, and update date.
    """
    
    super().__init__(quarters_type = Quarters.PASSEL_QUARTERS)
    
    def __repr__(self):
        """
        Returns a string representation of the object.
        
        The returned string includes the name, description, avatar, quarters_type,
        created_at, and updated_at attributes of the object.
        """
        return f"<PasselQuarters(name='{self.name}', description='{self.description}', avatar='{self.avatar}', quarters_type='{self.quarters_type}', created_at='{self.created_at}', updated_at='{self.updated_at}')>"
    
class LeaderQuarters(Quarters):
    """
    Represents the leader quarters.
    """

    super().__init__(quarters_type = Quarters.LEADER_QUARTERS)
    
    def __repr__(self):
        return f"<LeaderQuarters(name='{self.name}', description='{self.description}', avatar='{self.avatar}', quarters_type='{self.quarters_type}', created_at='{self.created_at}', updated_at='{self.updated_at}')>"
    
class AttendeeQuarters(Quarters):
    super().__init__(quarters_type = Quarters.ATTENDEE_QUARTERS)
    
    def __repr__(self):
        return f"<AttendeeQuarters(name='{self.name}', description='{self.description}', avatar='{self.avatar}', quarters_type='{self.quarters_type}', created_at='{self.created_at}', updated_at='{self.updated_at}')>"

class FacultyQuarters(Quarters):
    super().__init__(quarters_type = Quarters.FACULTY_QUARTERS)
    
    def __repr__(self):
        return f"<FacultyQuarters(name='{self.name}', description='{self.description}', avatar='{self.avatar}', quarters_type='{self.quarters_type}', created_at='{self.created_at}', updated_at='{self.updated_at}')>"

class Department(Base):
    __tablename__ = 'department'
    id = Column(Integer, primary_key=True, autoincrement="auto")
    name = Column(String(255))
    description = Column(Text)
    avatar = Column(String(255))
    faculty = relationship("Faculty", back_populates="department")
    parent_id = Column(Integer, ForeignKey('department.id'))
    subdepartments = relationship('Department', backref=backref('parent', remote_side=[id]))

    def __repr__(self):
        return f"<Department(name='{self.name}', description='{self.description}', avatar='{self.avatar}')>"
    
    
    