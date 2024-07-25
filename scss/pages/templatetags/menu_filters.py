# pages/templatetags/menu_filters.py

from django import template

register = template.Library()

@register.filter
def is_visible(item, user):
    """
    Determine if the menu item is visible to the user.
    """
    if not item.get('visible_to'):
        return True
    if item['visible_to'] == 'guest' and not user.is_authenticated:
        return True
    return bool(item['visible_to'] == 'authenticated' and user.is_authenticated)
