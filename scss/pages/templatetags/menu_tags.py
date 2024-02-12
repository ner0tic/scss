""" Menu Tag. """
from django import template
from django.shortcuts import get_object_or_404
from django.template.loader import render_to_string
from django.urls import ResolverMatch, resolve, reverse
from django.utils.safestring import mark_safe

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
    user_profile = request.user.get_profile()
    url_kwargs = {}

    def set_kwarg(name):
        # Logic to determine URL kwargs based on user profile
        if hasattr(user_profile, f'{name}_id'):
            url_kwargs[f'{name}_id'] = getattr(user_profile, f'{name}_id')
        elif hasattr(user_profile, f'{name}_slug'):
            url_kwargs[f'{name}_slug'] = getattr(user_profile, f'{name}_slug')

    return reverse(url_name, kwargs=url_kwargs)


@register.simple_tag(takes_context=True)
def render_menu(context, menu_name, template_name="menu/base_menu.html"):
    request = context["request"]
    user = request.user
    profile = user.get_profile()
    menu = get_object_or_404(Menu, name=menu_name)
    menu_items = menu.items.all()

    filtered_items = []
    for item in menu_items:
        if (
            item.visible_to == "all"
            or (item.visible_to == "authenticated" and user.is_authenticated)
            or (item.visible_to == "guest" and not user.is_authenticated)
        ):
            filtered_items.append(item)
        item.url = dynamic_url(context, item.url_name)
    return mark_safe(
        render_to_string(template_name, {"menu_items": filtered_items}, request)
    )


@register.simple_tag(takes_context=True)
def render_top_links(context, menu_name, template_name="menu/top_links.html"):
    return render_menu(context, menu_name, template_name)


def render_menu_item(item):
    url_params = item.url_params if isinstance(item.url_params, dict) else {}
    url = reverse(item.url_name, kwargs=url_params)
    return f'<a href="{url}">{item.title}</a>'
