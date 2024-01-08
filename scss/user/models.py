""" User models. """
from flask_login import UserMixin
from sqlalchemy import Column, Integer, String, Boolean, ForeignKey, DateTime
from sqlalchemy.orm import relationship

from ..database import db, CRUDMixin, BaseMixin, AuditMixin, UserSlugMixin
from ..extensions import bcrypt
from ..address.models import Address

class User(BaseMixin, CRUDMixin, UserMixin, AuditMixin, UserSlugMixin, db.Model):
    """ User Model. """
    id = Column(Integer, primary_key=True)
    username = Column(String(20), nullable=False, unique=True)
    email = Column(String(128), nullable=False, unique=True)
    pw_hash = Column(String(60), nullable=False)

    first_name = Column(String(255), nullable=False)
    last_name = Column(String(255), nullable=False)

    avatar_url = Column(String(255))
    role = Column(String(255))

    last_seen = Column(DateTime(timezone=True))

    address_id = Column(Integer, ForeignKey('address.id'), nullable=False)
    address = relationship('Address', foreign_keys=[address_id])

    remote_addr = Column(String(20))
    active = Column(Boolean())
    is_admin = Column(Boolean())


    def __init__(self, password, **kwargs):
        super(User, self).__init__(**kwargs)
        self.set_password(password)


    def set_password(self, password):
        hash_ = bcrypt.generate_password_hash(password, 10).decode('utf-8')
        self.pw_hash = hash_


    def check_password(self, password):
        return bcrypt.check_password_hash(self.pw_hash, password)
