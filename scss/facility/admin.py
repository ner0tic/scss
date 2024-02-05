""" Facility Related Admin Views. """
from django.contrib import admin
from django.contrib.contenttypes.admin import GenericStackedInline
from .models import Facility, Faculty, FacultyProfile, Department, Quarters
from address.models import Address

# If the Address model is editable in the admin, create an inline for it
class AddressInline(GenericStackedInline):
    model = Address
    extra = 1
    verbose_name = "Address"
    verbose_name_plural = "Address"


@admin.register(Facility)
class FacilityAdmin(admin.ModelAdmin):
    list_display = ('name', 'organization')
    list_filter = ('organization',)
    search_fields = ('name',)
    inlines = [AddressInline]
    fieldsets = (
        (None, {
            'fields': ('name', 'description', 'organization')
        }),
    )
    verbose_name_plural = "Facilities"

    def get_queryset(self, request):
        """
        Modify the queryset to prefetch related organization information
        for performance optimization.
        """
        queryset = super().get_queryset(request)
        queryset = queryset.select_related('organization')
        return queryset


@admin.register(Department)
class DepartmentAdmin(admin.ModelAdmin):
    list_display = ('name', 'abbreviation', 'parent', 'facility')
    list_filter = ('facility', 'parent')
    search_fields = ('name', 'abbreviation')
    fieldsets = (
        (None, {
            'fields': ('name', 'abbreviation', 'description', 'parent', 'facility')
        }),
    )

    def get_queryset(self, request):
        """
        Modify the queryset to prefetch related parent and facility information
        for performance optimization.
        """
        queryset = super().get_queryset(request)
        queryset = queryset.select_related('parent', 'facility')
        return queryset


from django.contrib import admin
from .models import Quarters

@admin.register(Quarters)
class QuartersAdmin(admin.ModelAdmin):
    list_display = ('name', 'facility', 'type', 'capacity')
    list_filter = ('facility', 'type')
    search_fields = ('name', 'facility__name')  # Assuming Facility model has a 'name' field
    fieldsets = (
        (None, {
            'fields': ('name', 'description', 'capacity', 'type', 'facility')
        }),
    )
    verbose_name_plural = "Quarters"

    def get_queryset(self, request):
        """
        Modify the queryset to prefetch related facility information
        for performance optimization.
        """
        queryset = super().get_queryset(request)
        queryset = queryset.select_related('facility')
        return queryset


@admin.register(Faculty)
class FacultyAdmin(admin.ModelAdmin):
    list_display = ('username', 'email', 'first_name', 'last_name')
    search_fields = ('username', 'email', 'first_name', 'last_name')
    verbose_name_plural = "Faculty"

    def save_model(self, request, obj, form, change):
        super().save_model(request, obj, form, change)
        if not change:  # Checking if it's a new object
            # Check if FacultyProfile already exists
            profile, created = FacultyProfile.objects.get_or_create(user=obj)
            if created or not profile.facility:
                # Set the faction if a new profile was created or if faction is not set
                profile.faction = form.cleaned_data.get('faction')
                profile.save()

# Inline for FacultyProfile
class FacultyProfileInline(admin.StackedInline):
    model = FacultyProfile
    can_delete = False
    extra = 0  # Prevents displaying an extra blank form
    verbose_name_plural = 'faculty profile'

# Extend FacultyAdmin to include FacultyProfile inline
class FacultyAdminWithProfile(FacultyAdmin):
    inlines = (FacultyProfileInline,)

# Replace FacultyAdmin with FacultyAdminWithProfile
admin.site.unregister(Faculty)
admin.site.register(Faculty, FacultyAdminWithProfile)