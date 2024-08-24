# facility/admin.py

from django.contrib import admin
from .models.facility import Facility
from .models.department import Department
from .models.quarters import Quarters, QuartersType


class DepartmentInline(admin.StackedInline):
    model = Department
    can_delete = False
    verbose_name_plural = "Departments"


class QuartersInline(admin.StackedInline):
    model = Quarters
    can_delete = False
    verbose_name_plural = "Quarters"


class FacilityAdmin(admin.ModelAdmin):
    list_display = ("name", "organization", "is_active", "created_at")
    search_fields = ("name", "organization__name")
    list_filter = ("is_active", "organization")
    ordering = ("name",)
    verbose_name_plural = 'Facilities'

    inlines = [DepartmentInline, QuartersInline]

    fieldsets = (
        (
            None,
            {
                "fields": (
                    "name",
                    "description",
                    "organization",
                    "slug",
                    "image",
                    "address",
                    "is_active",
                )
            },
        ),
        ("Timestamps", {"fields": ("created_at", "updated_at")}),
    )

    readonly_fields = ("created_at", "updated_at")


class QuartersTypeAdmin(admin.ModelAdmin):
    list_display = ("name", "organization", "is_active", "created_at")
    search_fields = ("name", "organization__name")
    list_filter = ("is_active", "organization")
    ordering = ("name",)

    inlines = [QuartersInline]

    fieldsets = (
        (
            None,
            {
                "fields": (
                    "name",
                    "description",
                    "organization",
                    "slug",
                    "image",
                    "is_active",
                )
            },
        ),
        ("Timestamps", {"fields": ("created_at", "updated_at")}),
    )

    readonly_fields = ("created_at", "updated_at")


class QuartersAdmin(admin.ModelAdmin):
    list_display = ("name", "facility", "type", "capacity", "is_active", "created_at")
    search_fields = ("name", "facility__name", "type__name")
    list_filter = ("is_active", "facility", "type")
    ordering = ("name",)
    verbose_plural_name = 'quarters'

    fieldsets = (
        (
            None,
            {
                "fields": (
                    "name",
                    "description",
                    "facility",
                    "type",
                    "slug",
                    "image",
                    "capacity",
                    "is_active",
                )
            },
        ),
        ("Timestamps", {"fields": ("created_at", "updated_at")}),
    )

    readonly_fields = ("created_at", "updated_at")


admin.site.register(Facility, FacilityAdmin)
admin.site.register(Department)
admin.site.register(Quarters, QuartersAdmin)
admin.site.register(QuartersType, QuartersTypeAdmin)
