# organization/admin.py

from django.contrib import admin
from .models.organization import Organization, OrganizationLabels, OrganizationSettings


class OrganizationLabelsInline(admin.StackedInline):
    model = OrganizationLabels
    can_delete = False
    verbose_name_plural = "Labels"


class OrganizationSettingsInline(admin.StackedInline):
    model = OrganizationSettings
    can_delete = False
    verbose_name_plural = "Settings"


class OrganizationAdmin(admin.ModelAdmin):
    list_display = ("name", "abbreviation", "is_active")#, "created_at")
    search_fields = ("name", "abbreviation")
    list_filter = ("is_active",)
    ordering = ("name",)

    inlines = [OrganizationLabelsInline, OrganizationSettingsInline]

    fieldsets = (
        (
            None,
            {
                "fields": (
                    "name",
                    "description",
                    "abbreviation",
                    "slug",
                    "image",
                    "parent",
                    "is_active",
                )
            },
        ),
        ("Hierarchy", {"fields": ("max_depth",)}),
        #("Timestamps", {"fields": ("created_at", "updated_at")}),
    )

    #readonly_fields = ("created_at", "updated_at")

    def save_model(self, request, obj, form, change):
        obj.save()  # Save the organization first
        if not hasattr(obj, "labels"):
            OrganizationLabels.objects.create(organization=obj)
        if not hasattr(obj, "settings"):
            OrganizationSettings.objects.create(organization=obj, labels=obj.labels)
        super().save_model(request, obj, form, change)


admin.site.register(Organization, OrganizationAdmin)
