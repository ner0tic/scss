""" Course models. """
from datetime import datetime

from scss.database import db, CRUDMixin

class Course(CRUDMixin, db.Model):
    """Represents a course in the system.

    This class provides a model for storing information about a course, including its name, description, avatar URL,
    requirements, prerequisites, course type, and creation/update timestamps.

    Args:
        name (str): The name of the course.
        description (str): The description of the course.
        avatar_url (str, optional): The URL of the course's avatar image.
        requirements (list of Requirement, optional): The requirements for the course.
        prerequisites (list of Requirement, optional): The prerequisites for the course.
        course_type (str, optional): The type of the course.
    
    Attributes:
        id (int): The unique identifier of the course.
        name (str): The name of the course.
        description (str): The description of the course.
        avatar_url (str): The URL of the course's avatar image.
        requirements (list of Requirement): The requirements for the course.
        prerequisites (list of Requirement): The prerequisites for the course.
        course_type (str): The type of the course.
        created_at (datetime): The timestamp when the course was created.
        updated_at (datetime): The timestamp when the course was last updated.
    """

    __tablename__ = 'course'
    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(50), nullable=False)
    description = db.Column(db.Text, nullable=False)
    avatar_url = db.Column(db.String(255))
    requirements = db.relationship('Requirement', backref='course', lazy=True)
    prerequisites = db.relationship('Requirement', backref='course', lazy=True)
    course_type = db.Column(db.String(50))
    created_at = db.Column(db.DateTime, nullable=False, default=datetime.now)
    updated_at = db.Column(db.DateTime, nullable=False, default=datetime.now)

class Requirement(CRUDMixin, db.Model):
    """Represents a requirement for a course.

    This class provides a model for storing information about a requirement, including its name, course ID,
    description, parent requirement, children requirements, and creation/update timestamps.

    Args:
        name (str): The name of the requirement.
        course_id (int): The ID of the course that the requirement belongs to.
        description (str): The description of the requirement.
        parent (Requirement, optional): The parent requirement of the current requirement.
        children (list of Requirement, optional): The children requirements of the current requirement.
    
    Attributes:
        id (int): The unique identifier of the requirement.
        name (str): The name of the requirement.
        course_id (int): The ID of the course that the requirement belongs to.
        description (str): The description of the requirement.
        parent (Requirement): The parent requirement of the current requirement.
        children (list of Requirement): The children requirements of the current requirement.
        created_at (datetime): The timestamp when the requirement was created.
        updated_at (datetime): The timestamp when the requirement was last updated.
    """

    __tablename__ = 'requirement'
    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(50), nullable=False)
    course_id = db.Column(db.Integer, db.ForeignKey('course.id'), nullable=False)
    description = db.Column(db.Text, nullable=False)
    parent_id = db.Column(db.Integer, db.ForeignKey('requirement.id'), nullable=True)
    children = db.relationship('Requirement', backref='parent', lazy=True)
    created_at = db.Column(db.DateTime, nullable=False, default=datetime.now)
    updated_at = db.Column(db.DateTime, nullable=False, default=datetime.now)
