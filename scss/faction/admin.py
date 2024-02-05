""" Faction Related Admin Views. """
from django.contrib import admin
from .models import Faction, Attendee, AttendeeProfile, Leader, LeaderProfile

# Admin for Faction
@admin.register(Faction)
class FactionAdmin(admin.ModelAdmin):
    list_display = ('name', 'abbreviation', 'organization')
    search_fields = ('name', 'abbreviation')
    list_filter = ('organization',)
    exclude = ('slug',)

# Admin for Attendee
@admin.register(Attendee)
class AttendeeAdmin(admin.ModelAdmin):
    list_display = ('username', 'email', 'first_name', 'last_name')
    search_fields = ('username', 'email', 'first_name', 'last_name')
    exclude = ('slug',)

    def save_model(self, request, obj, form, change):
        super().save_model(request, obj, form, change)
        if not change:  # Checking if it's a new object
            # Check if AttendeeProfile already exists
            profile, created = AttendeeProfile.objects.get_or_create(user=obj)
            if created or not profile.faction:
                # Set the faction if a new profile was created or if faction is not set
                profile.faction = form.cleaned_data.get('faction')
                profile.save()

# Inline for AttendeeProfile
class AttendeeProfileInline(admin.StackedInline):
    model = AttendeeProfile
    can_delete = False
    extra = 0  # Prevents displaying an extra blank form
    verbose_name_plural = 'attendee profile'

# Extend AttendeeAdmin to include AttendeeProfile inline
class AttendeeAdminWithProfile(AttendeeAdmin):
    inlines = (AttendeeProfileInline,)

# Replace AttendeeAdmin with AttendeeAdminWithProfile
admin.site.unregister(Attendee)
admin.site.register(Attendee, AttendeeAdminWithProfile)

# Admin for Leader
@admin.register(Leader)
class LeaderAdmin(admin.ModelAdmin):
    list_display = ('username', 'email', 'first_name', 'last_name')
    search_fields = ('username', 'email', 'first_name', 'last_name')
    exclude = ('slug',)
    
    def save_model(self, request, obj, form, change):
        super().save_model(request, obj, form, change)
        if not change:  # Checking if it's a new object
            # Check if LeaderProfile already exists
            profile, created = LeaderProfile.objects.get_or_create(user=obj)
            if created or not profile.faction:
                # Set the faction if a new profile was created or if faction is not set
                profile.faction = form.cleaned_data.get('faction')
                profile.save()

# Inline for LeaderProfile
class LeaderProfileInline(admin.StackedInline):
    model = LeaderProfile
    can_delete = False
    extra = 0  # Prevents displaying an extra blank form
    verbose_name_plural = 'leader profile'

# Extend LeaderAdmin to include LeaderProfile inline
class LeaderAdminWithProfile(LeaderAdmin):
    inlines = (LeaderProfileInline,)

# Replace LeaderAdmin with LeaderAdminWithProfile
admin.site.unregister(Leader)
admin.site.register(Leader, LeaderAdminWithProfile)