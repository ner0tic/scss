from django.contrib import admin
from django.core.management import call_command

from .models import (ActiveEnrollment, AttendeeClassEnrollment,
                     AttendeeEnrollment, FacilityClass,
                     FacilityClassEnrollment, FacilityEnrollment,
                     FactionEnrollment, FacultyClassEnrollment,
                     FacultyEnrollment, LeaderEnrollment, OrganizationCourse,
                     OrganizationEnrollment, Period, Week)


def balance_classes(modeladmin, request, queryset):
    # Example: Balancing for selected FacilityClasses
    for facility_class in queryset:
        call_command("balance_classes", facility_class=facility_class.id)


balance_classes.short_description = "Balance selected classes"


@admin.register(OrganizationEnrollment)
class OrganizationEnrollmentAdmin(admin.ModelAdmin):
    list_display = ("name", "organization", "start_timestamp", "end_timestamp")
    list_filter = ("organization",)
    search_fields = ("name", "organization__name")
    exclude = ("slug",)


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
    exclude = ("slug",)


@admin.register(Week)
class WeekAdmin(admin.ModelAdmin):
    list_display = ("name", "facility_enrollment", "start_timestamp", "end_timestamp")
    list_filter = ("facility_enrollment",)
    search_fields = ("name",)
    exclude = ("slug",)


@admin.register(Period)
class PeriodAdmin(admin.ModelAdmin):
    list_display = ("name", "week", "start_timestamp", "end_timestamp")
    list_filter = ("week",)
    search_fields = ("name",)
    exclude = ("slug",)


class AttendeeClassEnrollmentInline(admin.TabularInline):
    model = AttendeeClassEnrollment
    extra = 1  # Number of empty forms to display


class AttendeeEnrollmentAdmin(admin.ModelAdmin):
    list_display = ("attendee", "faction_enrollment", "quarters")
    search_fields = ("attendee__username", "faction_enrollment__name")
    inlines = [AttendeeClassEnrollmentInline]


admin.site.register(AttendeeEnrollment, AttendeeEnrollmentAdmin)


class FacultyClassEnrollmentInline(admin.TabularInline):
    model = FacultyClassEnrollment
    extra = 1  # Number of empty forms to display


class FacultyEnrollmentAdmin(admin.ModelAdmin):
    list_display = ("faculty", "facility_enrollment", "quarters")
    search_fields = ("faculty__username", "facility_enrollment__name")
    inlines = [FacultyClassEnrollmentInline]


admin.site.register(FacultyEnrollment, FacultyEnrollmentAdmin)


class LeaderEnrollmentAdmin(admin.ModelAdmin):
    list_display = ("leader", "faction_enrollment")
    search_fields = ("leader__username", "faction_enrollment__name")


admin.site.register(LeaderEnrollment, LeaderEnrollmentAdmin)


class FactionEnrollmentAdmin(admin.ModelAdmin):
    list_display = ("faction", "week", "quarters")
    list_filter = ("faction", "week__facility_enrollment__organization_enrollment")
    search_fields = ("faction__name", "week__facility_enrollment__name")
    raw_id_fields = (
        "quarters",
    )  # Use this for ForeignKey or ManyToMany fields to improve performance

    def formfield_for_foreignkey(self, db_field, request, **kwargs):
        if db_field.name == "quarters":
            pass
        #            kwargs["queryset"] = Quarters.objects.filter(facility__organization=request.user.organization)
        return super().formfield_for_foreignkey(db_field, request, **kwargs)


admin.site.register(FactionEnrollment, FactionEnrollmentAdmin)


class ActiveEnrollmentAdmin(admin.ModelAdmin):
    list_display = (
        "user",
        "attendee_enrollment",
        "leader_enrollment",
        "faction_enrollment",
        "faculty_enrollment",
        "facility_enrollment",
    )
    list_filter = (
        "user",
        "attendee_enrollment__faction_enrollment__faction",
        "leader_enrollment__faction_enrollment__faction",
        "faculty_enrollment__facility_enrollment__facility",
        "facility_enrollment__facility",
    )
    search_fields = (
        "user__username",
        "attendee_enrollment__faction__name",
        "leader_enrollment__faction__name",
        "faculty_enrollment__faculty__name",
        "facility_enrollment__facility__name",
    )


admin.site.register(ActiveEnrollment, ActiveEnrollmentAdmin)


class FacilityClassEnrollmentInline(admin.TabularInline):
    model = FacilityClassEnrollment
    extra = 1  # Adjust as needed


class OrganizationCourseAdmin(admin.ModelAdmin):
    list_display = ("course", "organization_enrollment")
    list_filter = ("course", "organization_enrollment")
    search_fields = ("course__name", "organization_enrollment__name")


admin.site.register(OrganizationCourse, OrganizationCourseAdmin)


class FacilityClassAdmin(admin.ModelAdmin):
    list_display = ("organization_course", "facility_enrollment")
    inlines = [FacilityClassEnrollmentInline]
    ordering = ["organization_course"]
    actions = [balance_classes]


admin.site.register(FacilityClass, FacilityClassAdmin)
