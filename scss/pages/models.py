from django.db import models
from django.contrib.auth.models import Permission


class Menu(models.Model):
    name = models.CharField(max_length=100)
    permissions = models.ManyToManyField(Permission, blank=True)

    def __str__(self):
        return self.name


class MenuItem(models.Model):
    menu = models.ForeignKey(
        Menu, related_name="items", on_delete=models.CASCADE, null=True
    )  # Temporarily allow null
    title = models.CharField(max_length=100, null=True)  # Temporarily allow null
    url_name = models.CharField(max_length=100, null=True)  # Temporarily allow null
    url_params = models.JSONField(default=dict, null=True, blank=True)
    image = models.ImageField(
        upload_to="menu_images/", blank=True, null=True
    )  # Optional image field
    image_path = models.CharField(
        max_length=255,
        blank=True,
        null=True,
        help_text="Relative path to a static image",
    )
    css_class = models.CharField(
        max_length=100, blank=True, null=True, help_text="CSS class for the menu item"
    )
    parent = models.ForeignKey(
        "self", null=True, blank=True, related_name="children", on_delete=models.CASCADE
    )
    # permissions = models.ManyToManyField(Permission, blank=True)
    visible_to = models.CharField(
        max_length=20,
        choices=(
            ("all", "All"),
            ("authenticated", "Authenticated"),
            ("guest", "Guest"),
        ),
        default="all",
    )

    def get_url(self):
        try:
            if self.url_params:
                return reverse(self.url_name, kwargs=self.url_params)
            else:
                return reverse(self.url_name)
        except Exception as e:
            # Handle exceptions or return a fallback URL
            return "#"

    def __str__(self):
        return self.title

    class Meta:
        ordering = ["menu", "parent__id", "id"]  # Ensures a consistent ordering
