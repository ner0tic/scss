# pages/menu.py

# Menu for Faculty Admin
FACULTY_ADMIN_MENU = [
    {"name": "Dashboard", "url_name": "dashboard", "icon": "fa-dashboard"},
    {
        "name": "Faculty Management",
        "url_name": "faculty:faculty_manage",
        "icon": "fa-users",
        "sub_items": [
            {"name": "View Faculty", "url_name": "faculty_index"},
            {"name": "Add/Edit Faculty", "url_name": "edit_faculty"},
           # {"name": "Assign Classes", "url_name": "assign_classes"},
        ],
    },
    {
        "name": "Class Management",
        "url_name": "class_management",
        "icon": "fa-book",
        "sub_items": [
            {"name": "View Classes", "url_name": "view_classes"},
            {"name": "Create/Edit Classes", "url_name": "edit_classes"},
            {"name": "Class Enrollments", "url_name": "class_enrollments"},
        ],
    },
    {
        "name": "Facility Management",
        "url_name": "facility_management",
        "icon": "fa-building",
        "sub_items": [
            {"name": "View Facility", "url_name": "view_facility"},
            {"name": "Edit Facility", "url_name": "edit_facility"},
            {"name": "Quarters Management", "url_name": "quarters_management"},
        ],
    },
    {"name": "Reports", "url_name": "reports", "icon": "fa-file"},
]

# Menu for Attendees
ATTENDEE_MENU = [
    {"name": "Dashboard", "url_name": "dashboard", "icon": "fa-dashboard"},
    {"name": "My Schedule", "url_name": "my_schedule", "icon": "fa-calendar"},
    {
        "name": "Courses",
        "url_name": "courses",
        "icon": "fa-book",
        "sub_items": [
            {"name": "View Courses", "url_name": "view_courses"},
            {"name": "Enroll in Courses", "url_name": "enroll_courses"},
        ],
    },
    {"name": "Resources", "url_name": "resources", "icon": "fa-folder"},
    {"name": "Notifications", "url_name": "notifications", "icon": "fa-bell"},
]

# Menu for Leaders
LEADER_MENU = [
    {"name": "Dashboard", "url_name": "dashboard", "icon": "fa-dashboard"},
    {
        "name": "Team Management",
        "url_name": "team_management",
        "icon": "fa-users",
        "sub_items": [
            {"name": "View Team", "url_name": "view_team"},
            {"name": "Manage Roles", "url_name": "manage_roles"},
        ],
    },
    {"name": "Reports", "url_name": "reports", "icon": "fa-file"},
]

# Menu for Leader Admin
LEADER_ADMIN_MENU = [
    {"name": "Dashboard", "url_name": "dashboard", "icon": "fa-dashboard"},
    {
        "name": "Leader Management",
        "url_name": "leader_management",
        "icon": "fa-users",
        "sub_items": [
            {"name": "View Leaders", "url_name": "view_leaders"},
            {"name": "Add/Edit Leaders", "url_name": "edit_leaders"},
            {"name": "Assign Tasks", "url_name": "assign_tasks"},
        ],
    },
    {"name": "Reports", "url_name": "reports", "icon": "fa-file"},
]

# Menu for Faculty
FACULTY_MENU = [
    {"name": "Dashboard", "url_name": "dashboard", "icon": "fa-dashboard"},
    {"name": "My Classes", "url_name": "my_classes", "icon": "fa-book"},
    {"name": "Assignments", "url_name": "assignments", "icon": "fa-tasks"},
    {"name": "Resources", "url_name": "resources", "icon": "fa-folder"},
]

# Menu for Organization Faculty
ORGANIZATION_FACULTY_MENU = [
    {"name": "Dashboard", "url_name": "dashboard", "icon": "fa-dashboard"},
    {
        "name": "Organization Management",
        "url_name": "organization_management",
        "icon": "fa-building",
        "sub_items": [
            {"name": "View Organization", "url_name": "view_organization"},
            {"name": "Manage Departments", "url_name": "manage_departments"},
        ],
    },
    {"name": "Reports", "url_name": "reports", "icon": "fa-file"},
]

toplinks = [
    {"title": "Help", "url_name": "help", "icon": "fa-circle-question"},
    {"title": "Sign Up", "url_name": "register", "visible_to": "guest"},
    {"title": "Sign In", "url_name": "login", "visible_to": "guest"},
    {
        "title": "Settings",
        "url_name": "account_settings",
        "visible_to": "authenticated",
        "icon": "fa-gears",
    },
    #        {"title": "Sign Out", "url_name": "signout", "visible_to": "authenticated"},
]
