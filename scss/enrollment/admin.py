from django.contrib import admin
from django.core.management import call_command
from .models import (
    OrganizationEnrollment,
    FacilityEnrollment,
    FactionEnrollment,
    LeaderEnrollment,
    Week,
    Period,
    OrganizationCourse,
    FacilityClass,
    FacilityClassEnrollment,
    AttendeeEnrollment,
    AttendeeClassEnrollment,
    FacultyClassEnrollment,
)

def balance_classes(modeladmin, request, queryset):
    # Example: Balancing for selected FacilityClasses
    for facility_class in queryset:
        call_command('balance_classes', facility_class=facility_class.id)

balance_classes.short_description = "Balance selected classes"

@admin.register(FacilityClass)
class FacilityClassAdmin(admin.ModelAdmin):
    list_display = ['facility_enrollment', 'organization_course']
    ordering = ['organization_course']
    actions = [balance_classes]

def balance_classes(modeladmin, request, queryset):
    # Example: Balancing for selected FacilityClasses
    for facility_class in queryset:
        call_command('balance_classes', facility_class=facility_class.id)

balance_classes.short_description = "Balance selected classes"


@admin.register(OrganizationEnrollment)
class OrganizationEnrollmentAdmin(admin.ModelAdmin):
    list_display = ("name", "organization", "start_timestamp", "end_timestamp")
    list_filter = ("organization",)
    search_fields = ("name", "organization__name")
    exclude = ('slug',)

@admin.register(FacilityEnrollment)
class FacilityEnrollmentAdmin(admin.ModelAdmin):
    list_display = (
        "name",
        "organization_enrollment",
        "facility",
        "start_timestamp",
        "end_timestamp",
    )
    list_filter = ("organization_enrollment", "facility")
    search_fields = ("name", "facility__name")
    exclude = ('slug',)

@admin.register(Week)
class WeekAdmin(admin.ModelAdmin):
    list_display = ("name", "facility_enrollment", "start_timestamp", "end_timestamp")
    list_filter = ("facility_enrollment",)
    search_fields = ("name",)
    exclude = ('slug',)


@admin.register(Period)
class PeriodAdmin(admin.ModelAdmin):
    list_display = ("name", "week", "start_timestamp", "end_timestamp")
    list_filter = ("week",)
    search_fields = ("name",)
    exclude = ('slug',)


admin.site.register(FactionEnrollment)
admin.site.register(LeaderEnrollment)
admin.site.register(AttendeeEnrollment)
admin.site.register(AttendeeClassEnrollment)
admin.site.register(FacilityClassEnrollment)
admin.site.register(OrganizationCourse)
admin.site.register(FacultyClassEnrollment)
