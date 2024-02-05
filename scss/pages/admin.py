from django.contrib import admin
from .models import Menu, MenuItem


class MenuItemInline(admin.TabularInline):
    model = MenuItem
    extra = 1  # How many rows to show


class MenuAdmin(admin.ModelAdmin):
    inlines = [MenuItemInline]


admin.site.register(Menu, MenuAdmin)


@admin.register(MenuItem)
class MenuItemAdmin(admin.ModelAdmin):
    list_display = (
        "title",
        "menu",
        "parent",
        "visible_to",
        "image_tag",
        "css_class",
    )  # Add a method to display image thumbnails
    list_filter = ("menu", "visible_to")

    def image_tag(self, obj):
        from django.utils.html import format_html

        if obj.image:
            return format_html(
                '<img src="{}" style="max-height: 50px;"/>', obj.image.url
            )
        return "-"

    image_tag.short_description = "Image Preview"
