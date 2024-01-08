""" Faction Related Models. """
from sqlalchemy import Column, Integer, String, Text, ForeignKey
from sqlalchemy.orm import relationship

from ..database import db, BaseMixin, CRUDMixin, AuditMixin, SlugMixin
from ..user.models import User

###################################################################################################
# Faction Related Models ##########################################################################
###################################################################################################



class FactionEnrollment(BaseMixin, CRUDMixin, AuditMixin, db.Model):
    """Class representing a Faction Enrollment.

    This class represents the enrollment of a Faction in a facility for a specific quarter. It has an ID, references to the Faction, Facility Enrollment, and Quarters it belongs to, and timestamps for creation and update.

    Attributes:
        id (int): The unique ID of the Faction Enrollment.
        faction_id (int): The ID of the Faction associated with the enrollment.
        facility_enrollment_id (int): The ID of the Facility Enrollment associated with the enrollment.
        quarters_id (int): The ID of the Quarters associated with the enrollment.
        created_at (datetime): The timestamp of when the Faction Enrollment was created.
        updated_at (datetime): The timestamp of when the Faction Enrollment was last updated.
    """
    __tablename__ = "faction_enrollment"

    id = Column(Integer, primary_key=True, autoincrement="auto")

    faction_id = Column(Integer, ForeignKey("faction.id"))
    faction = relationship('Faction')

    facility_enrollment_id = Column(Integer, ForeignKey("facility_enrollment.id"))
    facility_enrollment = relationship('FacilityEnrollment')

    quarters_id = Column(Integer, ForeignKey("quarters.id"))
    quarters = relationship('Quarters')


###################################################################################################
# Attendee Related Models #########################################################################
###################################################################################################
class Attendee(User, BaseMixin, CRUDMixin, AuditMixin, SlugMixin):
    """Class representing an Attendee.

    This class represents an Attendee, which is a type of User in the system. An Attendee has a
    user ID, a user role, and can be associated with a Faction, an Attendee Enrollment, and an
    Organization.

    Attributes:
        user_id (int): The ID of the User associated with the Attendee.
        user_role (str): The role of the Attendee.
        faction_id (int): The ID of the Faction associated with the Attendee.
        enrollment_id (int): The ID of the Attendee Enrollment associated with the Attendee.
        organization_id (int): The ID of the Organization associated with the Attendee.

    Methods:
        __repr__(): Returns a string representation of the Attendee.
        __init__(*args, **kwargs): Initializes a new Attendee instance.
    """
    __tablename__ = "attendee"

    user_id = Column(Integer, ForeignKey("user.id"), primary_key=True)
    user_role = Column(String(255), nullable=False, default="attendee")

    faction_id = Column(Integer, ForeignKey("faction.id"))
    faction = relationship('Faction')

    organization_id = Column(Integer, ForeignKey("organization.id"))
    organization = relationship('Organization')

    enrollments = relationship('AttendeeEnrollment')

    def __init__(self, *args, **kwargs):
        super().__init__(*args, **kwargs)
        self.user_role = "attendee"


class AttendeeEnrollment(BaseMixin, CRUDMixin, AuditMixin, db.Model):
    """Class representing an Attendee Enrollment.

    This class represents the enrollment of an Attendee in a Faction for a specific quarter. It has
    an ID, references to the Attendee, Faction Enrollment, and Quarters it belongs to, a list of
    Attendee Class Enrollments associated with it, and timestamps for creation and update.

    Attributes:
        id (int): The unique ID of the Attendee Enrollment.
        attendee_id (int): The ID of the Attendee associated with the enrollment.
        faction_enrollment_id (int): The ID of the Faction Enrollment associated with the enrollment.
        quarters_id (int): The ID of the Quarters associated with the enrollment.
        attendee_facility_class_enrollments (List[AttendeeClassEnrollment]): The Attendee Class Enrollments associated with the Attendee Enrollment.
        created_at (datetime): The timestamp of when the Attendee Enrollment was created.
        updated_at (datetime): The timestamp of when the Attendee Enrollment was last updated.
    """
    __tablename__ = "attendee_enrollment"

    attendee_id = Column(Integer, ForeignKey("attendee.user_id"))
    attendee = relationship('Attendee')

    faction_enrollment_id = Column(Integer, ForeignKey("faction_enrollment.id"))
    faction_enrollment = relationship('FactionEnrollment')

    quarters_id = Column(Integer, ForeignKey("quarters.id"))
    quarters = relationship('Quarters')

    attendee_facility_class_enrollments = relationship("AttendeeFacilityClassEnrollment")


class AttendeeFacilityClassEnrollment(BaseMixin, CRUDMixin, AuditMixin, db.Model):
    """Class representing an Attendee Class Enrollment.

    This class represents the enrollment of an Attendee in a Facility Class. It has an ID,
    references to the Attendee Enrollment and Facility Class it belongs to, and timestamps for
    creation and update.

    Attributes:
        id (int): The unique ID of the Attendee Class Enrollment.
        attendee_enrollment_id (int): The ID of the Attendee Enrollment associated with the
            enrollment.
        facility_class_id (int): The ID of the Facility Class associated with the enrollment.
        created_at (datetime): The timestamp of when the Attendee Class Enrollment was created.
        updated_at (datetime): The timestamp of when the Attendee Class Enrollment was last updated.
    """
    __tablename__ = "attendee_facility_class_enrollment"

    attendee_enrollment_id = Column(Integer, ForeignKey("attendee_enrollment.id"))
    attendee_enrollment = relationship('AttendeeEnrollment')

    facility_class_id = Column(Integer, ForeignKey("facility_class.id"))
    facility_class = relationship('FacilityClass')


###################################################################################################
# Leader Related Models ###########################################################################
###################################################################################################


class LeaderEnrollment(BaseMixin, CRUDMixin, AuditMixin, db.Model):
    """Class representing a Leader Enrollment.

    This class represents the enrollment of a Leader in a Faction for a specific faction enrollment.
    It has an ID, references to the Leader, Faction Enrollment, and Quarters it belongs to, and
    timestamps for creation and update.

    Attributes:
        id (int): The unique ID of the Leader Enrollment.
        leader_id (int): The ID of the Leader associated with the enrollment.
        faction_enrollment_id (int): The ID of the Faction Enrollment associated with the enrollment.
        quarters_id (int): The ID of the Quarters associated with the enrollment.
        created_at (datetime): The timestamp of when the Leader Enrollment was created.
        updated_at (datetime): The timestamp of when the Leader Enrollment was last updated.
    """
    __tablename__ = "attendee_enrollment"

    leader_id = Column(Integer, ForeignKey("leader.user_id"))
    leader = relationship("Leader")

    faction_enrollment_id = Column(Integer, ForeignKey("faction_enrollment.id"))
    faction_enrollment = relationship("FactionEnrollment")

    quarters_id = Column(Integer, ForeignKey("quarters.id"))
    quarters = relationship("Quarters")
