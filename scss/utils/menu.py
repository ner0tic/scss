""" Navigation Menu System """
from flask import url_for
from flask_principal import Permission, RoleNeed

class MenuItem:
    """
    Represents a menu item.

    Args:
        name (str): The name of the menu item.
        endpoint (str): The endpoint associated with the menu item.
        roles (list, optional): The roles required to access the menu item. Defaults to None.

    Attributes:
        name (str): The name of the menu item.
        endpoint (str): The endpoint associated with the menu item.
        roles (list): The roles required to access the menu item.

    Methods:
        __init__(name: str, endpoint: str, roles: Optional[list] = None): Initializes a new
            instance of the MenuItem class.
        is_accessible() -> bool: Checks if the menu item is accessible based on the roles assigned.

    Returns:
        bool: True if the menu item is accessible, False otherwise.
    """
    def __init__(self, name, endpoint, roles=None):
        """
        Initializes a new instance of the class.

        Args:
            name (str): The name of the instance.
            endpoint (str): The endpoint associated with the instance.
            roles (list, optional): The roles assigned to the instance. Defaults to None.

        Attributes:
            name (str): The name of the instance.
            endpoint (str): The endpoint associated with the instance.
            roles (list): The roles assigned to the instance.
        """
        self.name = name
        self.endpoint = endpoint
        self.roles = roles

    def is_accessible(self):
        """
        Checks if the instance is accessible based on the assigned roles.

        Returns:
            bool: True if the instance is accessible, False otherwise.
        """
        if not self.roles:
            return True
        return any(Permission(RoleNeed(role)).can() for role in self.roles)

class Menu:
    """
    Represents a menu.

    Args:
        items (list, optional): The initial list of menu items. Defaults to None.

    Attributes:
        items (list): The list of menu items.

    Methods:
        __init__(items: Optional[list] = None): Initializes a new instance of the Menu class.
        add_item(menu_item): Adds a menu item to the menu.
        get_items() -> list: Returns a list of accessible menu items.
    """
    def __init__(self, items=None):
        """
        Initializes a new instance of the class.

        Args:
            items (list, optional): The initial list of items. Defaults to None.

        Attributes:
            items (list): The list of items.
        """

        self.items = items or []

    def add_item(self, menu_item):
        """
        Adds a menu item to the menu.

        Args:
            menu_item: The menu item to be added.
        """

        self.items.append(menu_item)

    def get_items(self):
        """
        Returns a list of accessible menu items.

        Returns:
            list: The list of accessible menu items.
        """

        return [item for item in self.items if item.is_accessible()]

