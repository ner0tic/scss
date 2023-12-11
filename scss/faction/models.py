import datetime
from scss.database import db, CRUDMixin
from scss.user.models import User

# Faction Related Models
class Faction(CRUDMixin, db.Model):
    __tablename__ = "faction"
    id = db.Column(db.Integer, primary_key = True, autoincrement = "auto")
    name = db.Column(db.String(255), nullable = False)
    short_name = db.Column(db.String(255), nullable = False)
    description = db.Column(db.TextArea(255), nullable = False)
    avatar_url = db.Column(db.String(255))
    organization_id = db.Column(db.Integer, db.ForeignKey('organization.id'))
#    organization = db.relationship("Faction", backref='factions', lazy=True)
    parent_id = db.Column(db.Integer, db.ForeignKey('faction.id'))
    parent = db.relationship("Faction", remote_side=[id], backref="children", overlaps="children")
#    patrols = db.relationship("Patrol", backref='faction')
    attendees = db.relationship("Attendee", backref='faction', lazy=True)
    leaders = db.relationship("Leader", backref='faction', lazy=True)
    enrollments = db.relationship("FactionEnrollment", backref='faction', lazy=True)
    created_at = db.Column(
        db.DateTime(timezone=True),
        default=datetime.datetime.utcnow
    )
    updated_at = db.Column(
        db.DateTime(timezone=True),
        default=datetime.datetime.utcnow
    )
    
    def __repr__(self) -> str:
        return super().__repr__()
    
    def __init__(self, *args, **kwargs):
        super().__init__(*args, **kwargs)
        self.short_name = self.name
    
# Attendee Related Models
class Attendee(User):
    __tablename__ = 'attendee'
    user_id = db.Column(db.Integer, db.ForeignKey('user.id'), primary_key = True)
    user_role = db.Column(db.String(255), nullable=False, default="attendee")
    faction_id = db.Column(db.Integer, db.ForeignKey('faction.id'))
#     faction = db.relationship("Faction", backref='attendees', lazy=True)
#    patrol_id = db.Column(db.Integer, db.ForeignKey('patrol.id'))
#    patrol = db.relationship("Patrol", backref='attendees', lazy=True)
    enrollment_id = db.Column(db.Integer, db.ForeignKey('attendee_enrollment.id'))

    def __repr__(self):
        return f"<Attendee(user_id='{self.user_id}', user_role='{self.user_role}', enrollment_id='{self.enrollment_id}', faction_id='{self.faction_id}')>"

    def __init__(self, *args, **kwargs):
        super().__init__(*args, **kwargs)
        self.user_role = "attendee"
    
# Leader Related Models
class Leader(User):
    __tablename__ = "leader"
    user_id = db.Column(db.Integer, db.ForeignKey('user.id'), primary_key = True)
    user_role = db.Column(db.String(255), nullable=False, default="leader")
    faction_id = db.Column(db.Integer, db.ForeignKey('faction.id'))
#    faction = db.relationship("Faction", backref='leaders', lazy=True)
    enrollment_id = db.Column(db.Integer, db.ForeignKey('leader_enrollment.id'))
    
    def __repr__(self):
        return f"<Leader(user_id='{self.user_id}', user_role='{self.user_role}', enrollment_id='{self.enrollment_id}', faction_id='{self.faction_id}')>"

    def __init__(self, *args, **kwargs):
        super().__init__(*args, **kwargs)
        self.user_role = "leader"