# faction/context_processors.py

from .models.faction import Faction
from .models.attendee import Attendee
from .models.leader import Leader


def faction_counts(request):
    if not request.user.is_authenticated:
        return {}

    faction = None
    if hasattr(request.user, "attendeeprofile"):
        faction = request.user.attendeeprofile.faction
    elif hasattr(request.user, "leaderprofile"):
        faction = request.user.leaderprofile.faction

    if faction:
        faction_data = {
            "user_faction": faction,
            "user_faction_attendee_count": faction.member_count(user_type="attendee"),
            "user_faction_leader_count": faction.member_count(user_type="leader"),
            "user_faction_sub_faction_count": faction.with_sub_faction_count(),
        }
    else:
        faction_data = {
            "user_faction": None,
            "user_faction_attendee_count": 0,
            "user_faction_leader_count": 0,
            "user_faction_sub_faction_count": 0,
        }

    return faction_data
