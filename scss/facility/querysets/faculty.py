# facility/querysets/faculty.py

from django.db import models


class FacultyQuerySet(models.QuerySet):
    def faculty(self):
        return self.filter(user_type="faculty")

    def by_facility(self, facility):
        return self.filter(facultyprofile__facility=facility)

    def by_organization(self, organization):
        all_organizations = [organization] + organization.get_all_children()
        return self.filter(facultyprofile__organization__in=all_organizations)
