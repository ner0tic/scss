# organization/utils.py

from .models.organization import OrganizationLabels

def get_user_organization_labels(user):
    organization_labels = None
    if hasattr(user, 'attendeeprofile'):
        organization_labels = user.attendeeprofile.organization.labels
    elif hasattr(user, 'leaderprofile'):
        organization_labels = user.leaderprofile.organization.labels
    elif hasattr(user, 'facultyprofile'):
        organization_labels = user.facultyprofile.organization.labels

    labels = {
        'attendee_label': 'Attendee',
        'facility_label': 'Facility',
        'faction_label': 'Faction',
        'sub_faction_label': 'Sub-Faction',
        'faculty_label': 'Faculty',
        'leader_label': 'Leader',
        'faculty_quarters_label': 'Faculty Quarters',
        'faction_quarters_label': 'Faction Quarters',
        'leader_quarters_label': 'Leader Quarters',
        'attendee_quarters_label': 'Attendee Quarters',
        'course_label': 'Course',
        'facility_enrollment_label': 'Facility Enrollment',
        'faction_enrollment_label': 'Faction Enrollment',
        'leader_enrollment_label': 'Leader Enrollment',
        'attendee_enrollment_label': 'Attendee Enrollment',
        'attendee_class_enrollment_label': 'Attendee Class Enrollment',
        'week_label': 'Week',
        'period_label': 'Period'
    }

    if organization_labels:
        for label in labels:
            labels[label] = getattr(organization_labels, label, labels[label])

    return labels
