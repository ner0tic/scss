# pages/context_processors.py

from django.contrib.auth.models import User

from enrollment.models.enrollment import ActiveEnrollment
from faction.models.faction import Faction
from .menus import (
    FACULTY_ADMIN_MENU,
    ATTENDEE_MENU,
    LEADER_MENU,
    LEADER_ADMIN_MENU,
    FACULTY_MENU,
    ORGANIZATION_FACULTY_MENU,
    toplinks
)

def dynamic_menu(request):
    if request.user.is_authenticated:
        user_type = request.user.user_type
        if user_type == "FACULTY" and request.user.is_admin:
            return {"menu_items": FACULTY_ADMIN_MENU}
        elif user_type == "ATTENDEE":
            return {"menu_items": ATTENDEE_MENU}
        elif user_type == "LEADER" and request.user.is_admin:
            return {"menu_items": LEADER_ADMIN_MENU}
        elif user_type == "LEADER":
            return {"menu_items": LEADER_MENU}
        elif user_type == "FACULTY":
            return {"menu_items": FACULTY_MENU}
        elif user_type == "ORGANIZATION_FACULTY":
            return {"menu_items": ORGANIZATION_FACULTY_MENU}
    return {"menu_items": []}

import logging


logger = logging.getLogger(__name__)


def top_links_menu(request):
    context = {"toplinks": toplinks}
    logger.debug("Top links menu context: %s", context)
    return context


def user_type(request):
    return {
        "user_type": (
            request.user.user_type if request.user.is_authenticated else "other"
        )
    }


def user_profile(request):
    if request.user.is_authenticated:
        return {"user_profile": request.user.get_profile()}
    else:
        return {"user_profile": []}


def active_enrollment(request):
    if request.user.is_superuser:
        return {}
    if active_enrollment_id := request.session.get("active_enrollment_id"):
        active_enrollment = ActiveEnrollment.objects.get(id=active_enrollment_id)
    elif request.user.is_authenticated:
        active_enrollment = ActiveEnrollment.objects.get(
            user_id=request.user.id
        ) or ActiveEnrollment(user_id=request.user.id)
    else:
        active_enrollment = ActiveEnrollment()
    faction_enrollment = active_enrollment.faction_enrollment or {}
    if faction_enrollment:
        faction_id = active_enrollment.faction_enrollment.faction.id or 0
        faction = (
            Faction.objects.with_member_count()
            .with_sub_faction_count()
            .get(id=faction_id)
        )
        active_enrollment.faction_enrollment.faction = faction

    return {"active_enrollment": active_enrollment}


def color_scheme_processor(request):
    """Returns a dictionary containing the color scheme for the website."""

    warm_orange = "#ea6900"
    deep_red = "#cc2500"
    earthy_brown = "#612809"
    creamy_white = "#fff8db"
    forest_green = "#556643"
    dark_charcoal = "#00100c"

    highlight = warm_orange
    call_to_action = deep_red
    bg_dk = earthy_brown
    bg_lt = creamy_white
    secondary = forest_green
    text = dark_charcoal

    colors = {
        "text": text,
        "bg_lt": bg_lt,
        "bg_dk": bg_dk,
        "secondary_highlight": secondary,
        "call_to_action": call_to_action,
        "primary": highlight,
    }

    return {"color_scheme": colors}
