""" Database models for the scss application."""
import datetime
from ..database import db, CRUDMixin

class Address(CRUDMixin, db.Model):
    """
    Class representing an Address.

    This class represents an address in the system. It inherits from the CRUDMixin class and is a model in the database. The Address class has attributes for the address ID, name, line 1, line 2, city, state, postal code, country, creation timestamp, and update timestamp. It provides a string representation of the address and an initializer method.

    Attributes:
        id (db.Integer): The ID of the address.
        name (db.String): The name of the address.
        line1 (db.String): The first line of the address.
        line2 (db.String): The second line of the address.
        city (db.String): The city of the address.
        state (db.String): The state of the address.
        postal_code (db.String): The postal code of the address.
        country (db.String): The country of the address.
        created_at (db.DateTime): The creation timestamp of the address.
        updated_at (db.DateTime): The update timestamp of the address.

    Methods:
        __repr__(): Generates a string representation of the address.
        __init__(**kwargs): Initializes the address with the provided keyword arguments.
    """

    __tablename__ = "address"
    id = db.Column(db.Integer, primary_key=True, autoincrement="auto")
    name = db.Column(db.String(255))
    line1 = db.Column(db.String(255), nullable=False)
    line2 = db.Column(db.String(255))
    city = db.Column(db.String(255), nullable=False)
    state = db.Column(db.String(255), nullable=False)
    postal_code = db.Column(db.String(255), nullable=False)
    country = db.Column(db.String(255), nullable=False)
    created_at = db.Column(
        db.DateTime(timezone=True),
        default=datetime.datetime.utcnow
    )
    updated_at = db.Column(
        db.DateTime(timezone=True),
        default=datetime.datetime.utcnow
    )

    def __repr__(self):
        return f"<Address(line1='{self.line1}', line2='{self.line2}', city='{self.city}', state='{self.state}', postal_code='{self.postal_code}', country='{self.country}', created_at='{self.created_at}', updated_at='{self.updated_at}')>"

    def __init__(self, **kwargs):
        super(Address, self).__init__(**kwargs)
