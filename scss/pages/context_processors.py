# pages/context_processors.py

from django.contrib.auth.models import User

from enrollment.models.enrollment import ActiveEnrollment
from faction.models.faction import Faction
from .menus import menu_items

import logging


logger = logging.getLogger(__name__)

def dynamic_menu(request):
    if not request.user.is_authenticated:
        return {}

    menu = menu_items.get(f"{request.user.user_type.lower()}", []).copy()

    if request.user.is_admin:
        menu += menu_items.get(f"{request.user.user_type.lower()}_admin", [])

    logger.debug("Dynamic menu context: %s", {'menu': menu})
    return {'menu': menu}

def top_links_menu(request):
    context = {"toplinks" : menu_items.get("toplinks", []).copy()}
    logger.debug("Top links menu context: %s", context)
    return context


def user_type(request):
    return {'user_type': request.user.user_type if request.user.is_authenticated else 'other'}

def user_profile(request):
    if request.user.is_authenticated:
        return {'user_profile': request.user.get_profile()}
    else:
        return { 'user_profile': [] }

def active_enrollment(request):
    if request.user.is_superuser:
        return {}
    if active_enrollment_id := request.session.get('active_enrollment_id'):
        active_enrollment = ActiveEnrollment.objects.get(id=active_enrollment_id)
    elif request.user.is_authenticated:
        active_enrollment = ActiveEnrollment.objects.get(user_id=request.user.id) or ActiveEnrollment(user_id=request.user.id)
    else:
        active_enrollment = ActiveEnrollment()
    faction_enrollment = active_enrollment.faction_enrollment or {}
    if faction_enrollment:
        faction_id = active_enrollment.faction_enrollment.faction.id or 0
        faction = Faction.objects.with_member_count().with_sub_faction_count().get(id=faction_id)
        active_enrollment.faction_enrollment.faction = faction

    return {'active_enrollment': active_enrollment}


def color_scheme_processor(request):
    """ Returns a dictionary containing the color scheme for the website. """

    warm_orange = '#ea6900'
    deep_red = '#cc2500'
    earthy_brown = '#612809'
    creamy_white = '#fff8db'
    forest_green = '#556643'
    dark_charcoal = '#00100c'

    highlight = warm_orange
    call_to_action = deep_red
    bg_dk = earthy_brown
    bg_lt = creamy_white
    secondary = forest_green
    text = dark_charcoal

    colors = {
        'text': text,
        'bg_lt': bg_lt,
        'bg_dk': bg_dk,
        'secondary_highlight': secondary,
        'call_to_action': call_to_action,
        'primary': highlight
    }

    return {'color_scheme': colors}
