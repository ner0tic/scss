""" Facility Enrollment Models. """
from sqlalchemy import Column, Integer, String, ForeignKey
from sqlalchemy.orm import relationship

from ...database import CRUDMixin, AuditMixin, SlugMixin

from .temporal_hierarchy import TemporalHierarchy


class FacilityEnrollment(TemporalHierarchy, AuditMixin, CRUDMixin, SlugMixin):
    """ Facility Enrollment Model. """
    id = Column(Integer, ForeignKey('temporal_hierarchy.id'), primary_key = True)
    name = Column(String(255), nullable = False)
    facility_id = Column(Integer, ForeignKey('facility.id'))
    facility = relationship('Facility')

    def __init__(self, *args, **kwargs):
        super(FacilityEnrollment, self).__init__(*args, **kwargs)
        self.name = kwargs.get('name', None)
        self.facility_id = kwargs.get('facility_id', None)
        super().__init__(args, kwargs)
