from django import template

register = template.Library()

@register.filter(name='lowercase')
def lowercase(value):
    """
    Converts a string into all lowercase.
    """
    return value.lower()

