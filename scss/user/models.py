""" User models. """
import datetime
from flask_login import UserMixin
from ..database import db, CRUDMixin
from ..extensions import bcrypt

class User(CRUDMixin, UserMixin, db.Model):
    """
    Class representing a User.

    This class represents a user in the system. It inherits from the CRUDMixin and UserMixin classes, and is a model in the database. The User class has attributes for the user's ID, username, email, password hash, first name, last name, avatar URL, role, last seen timestamp, address ID, creation timestamp, update timestamp, remote address, active status, and admin status. It also provides methods for initializing the user, setting and checking the password, and generating a string representation of the user.

    Attributes:
        id (db.Integer): The ID of the user.
        username (db.String): The username of the user.
        email (db.String): The email of the user.
        pw_hash (db.String): The password hash of the user.
        first_name (db.String): The first name of the user.
        last_name (db.String): The last name of the user.
        avatar_url (db.String): The avatar URL of the user.
        role (db.String): The role of the user.
        last_seen (db.DateTime): The last seen timestamp of the user.
        address_id (db.Integer): The ID of the user's address.
        created_at (db.DateTime): The creation timestamp of the user.
        updated_at (db.DateTime): The update timestamp of the user.
        remote_addr (db.String): The remote address of the user.
        active (db.Boolean): The active status of the user.
        is_admin (db.Boolean): The admin status of the user.

    Methods:
        __init__(password, **kwargs): Initializes the user with the provided password and additional keyword arguments.
        __repr__(): Generates a string representation of the user.
        set_password(password): Sets the password hash for the user based on the provided password.
        check_password(password): Checks if the provided password matches the user's password hash.

    """

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
