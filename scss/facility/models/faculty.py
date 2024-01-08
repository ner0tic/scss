""" Facility Related Models """
from sqlalchemy import Column, Integer, String, ForeignKey
from sqlalchemy.orm import relationship

from ...database import AuditMixin, UserSlugMixin
from ...user.models import User

class Faculty(User, AuditMixin, UserSlugMixin):
    """Faculty User Model."""

    __tablename__ = "faculty"

    user_id = Column(Integer, ForeignKey("user.id"), primary_key=True)
    user_role = Column(String(255), nullable=False, default="faculty")

    # Relationships
    enrollment_id = Column(Integer, ForeignKey("faculty_enrollment.id"))
    enrollment = relationship("FacultyEnrollment", backref="faculty")

    facility_id = Column(Integer, ForeignKey("facility.id"))
    facility = relationship('Facility', back_populates="faculty", primaryjoin="Faculty.facility_id == Facility.id")

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
