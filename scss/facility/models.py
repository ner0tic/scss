""" Facility Models """
import datetime
from ..database import db, CRUDMixin
from ..user.models import User


###################################################################################################
# Facility Related Models #########################################################################
###################################################################################################
class Facility(CRUDMixin, db.Model):
    """
    Represents a Facility.

    This class represents a facility with attributes such as name, description, avatar, address,
    organization, and quarters.
    It inherits from the CRUDMixin and db.Model classes.
    """

    __tablename__ = "facility"

    id = db.Column(db.Integer, primary_key=True, autoincrement="auto")
    name = db.Column(db.String(255), nullable=False)
    description = db.Column(db.String(255), nullable=False)
    avatar = db.Column(db.String(255))
    # Relationships
    address_id = db.Column(db.Integer, db.ForeignKey("address.id"))
    #    address = relationship("Address", backref="facility")
    organization_id = db.Column(db.Integer, db.ForeignKey("organization.id"))
    quarters = db.relationship("Quarters", backref="facility")
    departments = db.relationship("Department", backref="facility")
    faculty = db.relationship("Faculty", backref="facility")
    # Timestamps
    created_at = db.Column(db.DateTime(timezone=True), default=datetime.datetime.utcnow)
    updated_at = db.Column(db.DateTime(timezone=True), default=datetime.datetime.utcnow)
    faculty_quarters = []
    attendee_quarters = []
    faction_quarters = []
    leader_quarters = []

    def __repr__(self):
        return f"<Facility(name='{self.name}', description='{self.description}', avatar='{self.avatar}', address='{self.address}', created_at='{self.created_at}', updated_at='{self.updated_at}')>"

    def __init__(self, *args, **kwargs):
        """
        Initializes a Facility object.

        Args:
            *args: Variable length argument list.
            **kwargs: Arbitrary keyword arguments.
        """
        for q in self.quarters:
            if q.quarters_type == Quarters.FACULTY_QUARTERS:
                self.faculty_quarters.append(q)
            elif q.quarters_type == Quarters.FACTION_QUARTERS:
                self.faction_quarters.append(q)
            elif q.quarters_type == Quarters.ATTENDEE_QUARTERS:
                self.attendee_quarters.append(q)
            elif q.quarters_type == Quarters.LEADER_QUARTERS:
                self.leader_quarters.append(q)

###################################################################################################
# Faculty Related Models ##########################################################################
###################################################################################################
class Faculty(User):
    """
    Represents a Faculty.

    This class represents a faculty with attributes such as user ID, user role, enrollment ID,
    facility ID, and department ID.
    It inherits from the User class.
    """

    __tablename__ = "faculty"

    user_id = db.Column(db.Integer, db.ForeignKey("user.id"), primary_key=True)
    user_role = db.Column(db.String(255), nullable=False, default="faculty")
    # Relationships
    enrollment_id = db.Column(db.Integer, db.ForeignKey("faculty_enrollment.id"))
    #    enrollment = relationship("FacultyEnrollment", backref="faculty")
    facility_id = db.Column(db.Integer, db.ForeignKey("facility.id"))
    #    facility = relationship("Facility", backref="faculty")
    department_id = db.Column(db.Integer, db.ForeignKey("department.id"))

    def __repr__(self):
        return f"<Faculty(user_id='{self.user_id}', user_role='{self.user_role}', enrollment_id='{self.enrollment_id}', facility_id='{self.facility_id}')>"

    def __init__(self, *args, **kwargs):
        """
        Initializes a Faculty object.

        Args:
            *args: Variable length argument list.
            **kwargs: Arbitrary keyword arguments.
        """
        super().__init__(*args, **kwargs)
        self.user_role = "faculty"

###################################################################################################
# Quarters Related Models #########################################################################
###################################################################################################
class Quarters(CRUDMixin, db.Model):
    """
    Represents a Quarters.

    This class represents a quarters with attributes such as name, description, avatar,
    quarters type, facility ID, and parent ID.
    It inherits from the CRUDMixin and db.Model classes.
    """

    FACTION_QUARTERS = 0
    LEADER_QUARTERS = 1
    ATTENDEE_QUARTERS = 2
    FACULTY_QUARTERS = 3
    OTHER_QUARTERS = 4

    __tablename__ = "quarters"

    id = db.Column(db.Integer, primary_key=True, autoincrement="auto")
    name = db.Column(db.String(255), nullable=False)
    description = db.Column(db.String(255), nullable=False)
    avatar = db.Column(db.String(255))
    quarters_type = db.Column(db.Integer, nullable=False, default=FACTION_QUARTERS)
    # Relationships
    facility_id = db.Column(db.Integer, db.ForeignKey("facility.id"))
#   facility = db.relationship("Facility", backref="quarters")
    parent_id = db.Column(db.Integer, db.ForeignKey("quarters.id"))
    parent = db.relationship("Quarters", remote_side=[id], backref="children")
#    children = db.relationship('Quarters', remote_side=[parent_id], backref="parent") # , overlaps="parent", uselist=True)
    # Timestamps
    created_at = db.Column(db.DateTime(timezone=True), default=datetime.datetime.utcnow)
    updated_at = db.Column(db.DateTime(timezone=True), default=datetime.datetime.utcnow)

    def __repr__(self):
        return f"<Quarters(name='{self.name}', description='{self.description}', avatar='{self.avatar}', quarters_type='{self.quarters_type}', created_at='{self.created_at}', updated_at='{self.updated_at}')>"

###################################################################################################
# Department Related Models #######################################################################
###################################################################################################
class Department(CRUDMixin, db.Model):
    """
    Represents a Department.
    
    This class represents a department with attributes such as name, description, avatar,
    facility ID, and parent ID.
    It inherits from the CRUDMixin and db.Model classes.
    """
    __tablename__ = "department"
    id = db.Column(db.Integer, primary_key=True, autoincrement="auto")
    name = db.Column(db.String(255))
    description = db.Column(db.String(255), nullable=False)
    avatar = db.Column(db.String(255))
    # Relationships
    facility_id = db.Column(db.Integer, db.ForeignKey("facility.id"))
#    facility = relationship("Facility", backref="department")
    faculty = db.relationship("Faculty", backref="department")
    parent_id = db.Column(db.Integer, db.ForeignKey("department.id"))
    parent = db.relationship(
        "Department", remote_side=[id], backref="children", overlaps="children"
    )
#    children = relationship('Department', backref='parent', remote_side=[id])
    # Timestamps
    created_at = db.Column(db.DateTime(timezone=True), default=datetime.datetime.utcnow)
    updated_at = db.Column(db.DateTime(timezone=True), default=datetime.datetime.utcnow)

    def __repr__(self):
        return f"<Department(name='{self.name}', description='{self.description}', avatar='{self.avatar}')>"
