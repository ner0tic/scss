""" Menu Tag. """
from django import template
from django.template.loader import render_to_string
from django.urls import ResolverMatch, resolve, reverse
from django.utils.safestring import mark_safe
from annoying.functions import get_object_or_None

from ..models import Menu

register = template.Library()

@register.simple_tag
def get_route_params(url_name):
    try:
        resolver_match = resolve(url_name)
        if isinstance(resolver_match, ResolverMatch):
            return resolver_match.kwargs.keys()
    except Exception as e:
        return []


@register.simple_tag(takes_context=True)
def dynamic_url(context, url_name, *args, **kwargs):
    request = context['request']

    url_kwargs = {}

    def set_kwarg(name):
        user_profile = request.user.get_profile()
        # Logic to determine URL kwargs based on user profile
        if hasattr(user_profile, f'{name}_id'):
            url_kwargs[f'{name}_id'] = getattr(user_profile, f'{name}_id')
        elif hasattr(user_profile, f'{name}_slug'):
            url_kwargs[f'{name}_slug'] = getattr(user_profile, f'{name}_slug')

    return reverse(url_name, kwargs=url_kwargs)


register = template.Library()

@register.inclusion_tag('partials/menu.html')
def render_menu(menu_items):
    return {"menu_items": menu_items}


@register.simple_tag(takes_context=True)
def render_top_links(context, menu_name, template_name="menu/top_links.html"):
    return render_menu(context, menu_name, template_name)


def render_menu_item(item):
    url_params = item.url_params if isinstance(item.url_params, dict) else {}
    url = reverse(item.url_name, kwargs=url_params)
    return f'<a href="{url}">{item.title}</a>'
