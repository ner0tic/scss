import datetime

from flask_login import UserMixin

from scss.database import db, CRUDMixin
from scss.extensions import bcrypt


class User(CRUDMixin, UserMixin, db.Model):
    id = db.Column(db.Integer, primary_key=True)
    username = db.Column(db.String(20), nullable=False, unique=True)
    email = db.Column(db.String(128), nullable=False, unique=True)
    pw_hash = db.Column(db.String(60), nullable=False)
    first_name = db.Column(db.String(255), nullable=False)
    last_name = db.Column(db.String(255), nullable=False)
    avatar_url = db.Column(db.String(255))
    role = db.Column(db.String(255))
    last_seen = db.Column(db.DateTime(timezone=True))
    address_id = db.Column(db.Integer, db.ForeignKey('address.id'), nullable=False)
    created_at = db.Column(
        db.DateTime(timezone=True),
        default=datetime.datetime.utcnow
    )
    updated_at = db.Column(
        db.DateTime(timezone=True),
        default=datetime.datetime.utcnow
    )
    remote_addr = db.Column(db.String(20))
    active = db.Column(db.Boolean())
    is_admin = db.Column(db.Boolean())

    def __init__(self, password, **kwargs):
        super(User, self).__init__(**kwargs)
        self.set_password(password)

    def __repr__(self):
        return f'<User #{self.id}:{self.username}>'

    def set_password(self, password):
        hash_ = bcrypt.generate_password_hash(password, 10).decode('utf-8')
        self.pw_hash = hash_

    def check_password(self, password):
        return bcrypt.check_password_hash(self.pw_hash, password)