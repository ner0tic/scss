# pages/menu.py


menu_items = {
    "attendee": [
        {"title": "My Schedule", "url_name": "my_schedule"},
        {"title": "Activities", "url_name": "activities"},
        {"title": "Notifications", "url_name": "notifications"},
    ],
    "leader": [
        {"title": "My Schedule", "url_name": "my_schedule"},
        {"title": "Activities", "url_name": "activities"},
        {"title": "Notifications", "url_name": "notifications"},
    ],
    "leader_admin": [
        {"title": "My Faction", "url_name": "my_faction"},
    ],
    "faculty": [
        {"title": "My Schedule", "url_name": "my_schedule"},
        {"title": "Activities", "url_name": "activities"},
        {"title": "Notifications", "url_name": "notifications"},
    ],
    "faculty_admin": [
        {"title": "My Facility", "url_name": "my_facility"},
    ],
    "toplinks": [
        {"title": "Help", "url_name": "help"},
        {"title": "Sign Up", "url_name": "register", "visible_to": "guest"},
        {"title": "Sign In", "url_name": "login", "visible_to": "guest"},
        {"title": "Settings", "url_name": "account_settings", "visible_to": "authenticated"},
        #{"title": "Sign Out", "url_name": "signout", "visible_to": "authenticated"},
    ],
}
