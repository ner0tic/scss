""" Leader Model. """
from sqlalchemy import Column, Integer, String, ForeignKey
from sqlalchemy.orm import relationship

from ...database import BaseMixin, CRUDMixin, AuditMixin, UserSlugMixin
from ...user.models import User

class Leader(User, BaseMixin, CRUDMixin, AuditMixin, UserSlugMixin):
    """ Class representing a Leader. """
    __tablename__ = "leader"

    user_id = Column(Integer, ForeignKey("user.id"), primary_key=True)
    user_role = Column(String(255), nullable=False, default="leader")

    faction_id = Column(Integer, ForeignKey("faction.id"))
    faction = relationship('Faction')

    enrollments = relationship('LeaderEnrollment')

    organization_id = Column(Integer, ForeignKey("organization.id"))
    organization = relationship('Organization')

    def __init__(self, *args, **kwargs):
        super().__init__(*args, **kwargs)
        self.user_role = "leader"
