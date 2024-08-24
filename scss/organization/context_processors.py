# organization/context_processors.py

from .models.organization import OrganizationLabels


def organization_labels(request):
    if not request.user.is_authenticated:
        return {}

    organization_labels = None

    # Check for user profiles and set organization_labels accordingly
    if hasattr(request.user, "attendeeprofile"):
        organization_labels = request.user.attendeeprofile.get_root_organization().labels
    elif hasattr(request.user, "leaderprofile"):
        organization_labels = request.user.leaderprofile.get_root_organization().labels
    elif hasattr(request.user, "facultyprofile"):
        organization_labels = request.user.facultyprofile.get_root_organization().labels

    # Default labels
    labels = {
        "attendee_label": "Attendee",
        "facility_label": "Facility",
        "faction_label": "Faction",
        "sub_faction_label": "Sub-Faction",
        "faculty_label": "Faculty",
        "leader_label": "Leader",
        "faculty_quarters_label": "Faculty Quarters",
        "faction_quarters_label": "Faction Quarters",
        "leader_quarters_label": "Leader Quarters",
        "attendee_quarters_label": "Attendee Quarters",
        "course_label": "Course",
        "facility_enrollment_label": "Facility Enrollment",
        "faction_enrollment_label": "Faction Enrollment",
        "leader_enrollment_label": "Leader Enrollment",
        "attendee_enrollment_label": "Attendee Enrollment",
        "attendee_class_enrollment_label": "Attendee Class Enrollment",
        "week_label": "Week",
        "period_label": "Period",
    }

    # If organization_labels is set, update the labels dictionary
    if organization_labels:
        for label in labels:
            labels[label] = getattr(organization_labels, label, labels[label])

    # Return the labels as part of the context
    return {"organization_labels": labels}
