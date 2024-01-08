""" Temporal Hierarchy. """
from sqlalchemy import Column, Integer, String, Text, DateTime, ForeignKey
from sqlalchemy.orm import relationship

from ...database import db, CRUDMixin, AuditMixin, SlugMixin


class TemporalHierarchy(CRUDMixin, AuditMixin, SlugMixin, db.Model):
    """Class: TemporalHierarchy

    A SQLAlchemy model representing a temporal hierarchy.

    Attributes:
        id: The primary key of the temporal hierarchy.
        name: The name of the temporal hierarchy.
        short_name: The short name of the temporal hierarchy.
        description: The description of the temporal hierarchy.
        avatar_url: The URL of the avatar for the temporal hierarchy.
        parent_id: The foreign key referencing the parent temporal hierarchy.
        parent: The relationship to the parent temporal hierarchy.
        children: The relationship to the child temporal hierarchies.
        organization_id: The foreign key referencing the organization.
        start: The start date of the temporal hierarchy.
        end: The end date of the temporal hierarchy.
        created_at: The timestamp indicating the creation time of the temporal hierarchy.
        updated_at: The timestamp indicating the last update time of the temporal hierarchy.
    """
    __tablename__ = "temporal_hierarchy"
    
    id = Column(Integer, primary_key=True, autoincrement="auto")
    name = Column(String(255), nullable=False)
    abbreviation = Column(String(50))
    description = Column(Text, nullable=False)
    avatar_url = Column(String(255))
    start = Column(DateTime(timezone=True), nullable=False)
    end = Column(DateTime(timezone=True), nullable=False)

    # Relationship
    parent_id = Column(Integer, ForeignKey("temporal_hierarchy.id"))
    parent = relationship(
        "TemporalHierarchy",
        remote_side=[id],
        backref="children",
        overlaps="children"
    )

    organization_id = Column(Integer, ForeignKey("organization.id"))
