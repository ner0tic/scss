""" Menu Tag. """
from django import template
from django.urls import reverse
from django.template.loader import render_to_string
from django.utils.safestring import mark_safe
from django.shortcuts import get_object_or_404

from ..models import Menu

register = template.Library()


@register.simple_tag(takes_context=True)
def render_menu(context, menu_name, template_name="menu/base_menu.html"):
    request = context["request"]
    user = request.user
    if user.is_authenticated:
        menu_items = Menu.objects.filter(
            name=menu_name, permissions__user=user
        ).distinct()
    else:
        menu_items = Menu.objects.filter(name=menu_name)  # .items.all()

    return mark_safe(
        render_to_string(template_name, {"menu_items": menu_items}, request)
    )


@register.simple_tag(takes_context=True)
def render_top_links(context, menu_name, template_name="menu/top_links.html"):
    request = context["request"]
    user = request.user
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
        item.url = reverse(
            item.url_name,
        )  # kwargs=item.url_params)
    return mark_safe(
        render_to_string(template_name, {"menu_items": filtered_items}, request)
    )


def render_menu_item(item):
    url_params = item.url_params if isinstance(item.url_params, dict) else {}
    url = reverse(item.url_name, kwargs=url_params)
    return f'<a href="{url}">{item.title}</a>'
