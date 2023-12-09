from scss.database import db, CRUDMixin
from sqlalchemy.sql import func

class Address(CRUDMixin, db.Model):
    __tablename__ = "address"
    id = db.Column(db.Integer, primary_key=True, autoincrement="auto")
    name = db.Column(db.String(255))
    line1 = db.Column(db.String(255), nullable=False)
    line2 = db.Column(db.String(255))
    city = db.Column(db.String(255), nullable=False)
    state = db.Column(db.String(255), nullable=False)
    postal_code = db.Column(db.String(255), nullable=False)
    country = db.Column(db.String(255), nullable=False)
    created_at = db.Column(db.DateTime, server_default=func.now())
    updated_at = db.Column(db.DateTime, onupdate=func.now())
    
    def __repr__(self):
        return f"<Address(line1='{self.line1}', line2='{self.line2}', city='{self.city}', state='{self.state}', postal_code='{self.postal_code}', country='{self.country}', created_at='{self.created_at}', updated_at='{self.updated_at}')>"

    def __init__(self, **kwargs):
        super(Address, self).__init__(**kwargs)