""" Organization Related Admin Views. """
from django.contrib import admin
from .models import Organization

class ChildOrganizationInline(admin.StackedInline):
    model = Organization
    verbose_name = "Sub-Organization"
    verbose_name_plural = "Sub-Organizations"
    fk_name = 'parent'
    extra = 1  # Number of empty forms to display
    fields = ('name', 'abbreviation', 'description')  # Fields to display in the inline

# Adjust OrganizationAdmin to include the inline
@admin.register(Organization)
class OrganizationAdmin(admin.ModelAdmin):
    list_display = ('name', 'abbreviation', 'parent')
    search_fields = ('name', 'abbreviation')
    list_filter = ('parent',)
    fieldsets = (
        (None, {
            'fields': ('name', 'abbreviation', 'description', 'parent')
        }),
    )
    inlines = [ChildOrganizationInline]
    exclude = ('slug',)

    def get_queryset(self, request):
        queryset = super().get_queryset(request)
        queryset = queryset.select_related('parent')
        return queryset

