""" Attendee Model. """
from sqlalchemy import Column, Integer, String, ForeignKey
from sqlalchemy.orm import relationship

from ...database import BaseMixin, CRUDMixin, AuditMixin, UserSlugMixin
from ...user.models import User

class Attendee(User, BaseMixin, CRUDMixin, AuditMixin, UserSlugMixin):
    """ Attendee Model. """
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
