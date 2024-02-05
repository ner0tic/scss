from .models import MenuItem

def menu_items_processor(request):
    if request.user.is_authenticated:
        # Get menu items based on user permissions
        menu_items = MenuItem.objects.filter(permissions__in=request.user.user_permissions.all()).distinct()
    else:
        # If the user is not authenticated, return an empty list or public menu items
        menu_items = MenuItem.objects.filter(permissions__isnull=True)

    return {'menu_items': menu_items}

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
