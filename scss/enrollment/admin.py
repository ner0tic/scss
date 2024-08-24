#enrollment/admin.py

from django.contrib import admin

from .models.enrollment import ActiveEnrollment
from .models.organization import OrganizationEnrollment, OrganizationCourse
from .models.temporal import Week, Period
from .models.faction import (
    FactionEnrollment,
    LeaderEnrollment,
    AttendeeEnrollment,
    AttendeeClassEnrollment,
)
from .models.facility import (
    FacilityEnrollment,
    FacilityClass,
    FacilityClassEnrollment,
    FacultyEnrollment,
    FacultyClassEnrollment,
)


# Inline classes for related models
class AttendeeClassEnrollmentInline(admin.TabularInline):
    model = AttendeeClassEnrollment
    extra = 1


class FacilityClassEnrollmentInline(admin.TabularInline):
    model = FacilityClassEnrollment
    extra = 1


class LeaderEnrollmentInline(admin.TabularInline):
    model = LeaderEnrollment
    extra = 1


class AttendeeEnrollmentInline(admin.TabularInline):
    model = AttendeeEnrollment
    extra = 1


class FacultyClassEnrollmentInline(admin.TabularInline):
    model = FacultyClassEnrollment
    extra = 1


# Admin classes for main models
@admin.register(ActiveEnrollment)
class ActiveEnrollmentAdmin(admin.ModelAdmin):
    list_display = ("user", "get_active_enrollment")
    search_fields = ("user__username", "user__email")
    list_filter = (
        "attendee_enrollment",
        "leader_enrollment",
        "faction_enrollment",
        "faculty_enrollment",
        "facility_enrollment",
    )

    def get_active_enrollment(self, obj):
        return obj.get_active_enrollment()

    get_active_enrollment.short_description = "Active Enrollment"


@admin.register(OrganizationEnrollment)
class OrganizationEnrollmentAdmin(admin.ModelAdmin):
    list_display = ("organization", "start", "end")
    search_fields = ("organization__name",)
    list_filter = ("start", "end")
    inlines = [FacilityClassEnrollmentInline]


@admin.register(OrganizationCourse)
class OrganizationCourseAdmin(admin.ModelAdmin):
    list_display = ("course", "organization_enrollment")
    search_fields = ("course__name", "organization_enrollment__organization__name")
    list_filter = ("organization_enrollment",)


@admin.register(Week)
class WeekAdmin(admin.ModelAdmin):
    list_display = ("name", "start", "end", "facility_enrollment")
    search_fields = ("name", "facility_enrollment__facility__name")
    list_filter = ("start", "end")


@admin.register(Period)
class PeriodAdmin(admin.ModelAdmin):
    list_display = ("name", "start", "end", "week")
    search_fields = ("name", "week__name")
    list_filter = ("start", "end", "week")


@admin.register(FactionEnrollment)
class FactionEnrollmentAdmin(admin.ModelAdmin):
    list_display = ("faction", "week", "quarters", "start", "end")
    search_fields = ("faction__name", "week__name")
    list_filter = ("start", "end", "quarters")
    inlines = [LeaderEnrollmentInline, AttendeeEnrollmentInline]


@admin.register(LeaderEnrollment)
class LeaderEnrollmentAdmin(admin.ModelAdmin):
    list_display = ("leader", "faction_enrollment", "quarters", "start", "end")
    search_fields = ("leader__name", "faction_enrollment__faction__name")
    list_filter = ("start", "end", "quarters")


@admin.register(AttendeeEnrollment)
class AttendeeEnrollmentAdmin(admin.ModelAdmin):
    list_display = ("attendee", "faction_enrollment", "quarters")
    search_fields = ("attendee__name", "faction_enrollment__faction__name")
    list_filter = ("quarters",)
    inlines = [AttendeeClassEnrollmentInline]


@admin.register(FacilityEnrollment)
class FacilityEnrollmentAdmin(admin.ModelAdmin):
    list_display = ("facility", "organization_enrollment", "start", "end")
    search_fields = ("facility__name", "organization_enrollment__organization__name")
    list_filter = ("start", "end")


@admin.register(FacilityClass)
class FacilityClassAdmin(admin.ModelAdmin):
    list_display = ("name", "organization_course", "facility_enrollment")
    search_fields = (
        "name",
        "organization_course__course__name",
        "facility_enrollment__facility__name",
    )
    list_filter = ("facility_enrollment",)
    inlines = [FacilityClassEnrollmentInline]


@admin.register(FacultyEnrollment)
class FacultyEnrollmentAdmin(admin.ModelAdmin):
    list_display = ("faculty", "facility_enrollment", "quarters")
    search_fields = ("faculty__name", "facility_enrollment__facility__name")
    list_filter = ("quarters",)
    inlines = [FacultyClassEnrollmentInline]


@admin.register(FacultyClassEnrollment)
class FacultyClassEnrollmentAdmin(admin.ModelAdmin):
    list_display = ("faculty", "facility_class_enrollment", "faculty_enrollment")
    search_fields = (
        "faculty__name",
        "facility_class_enrollment__facility_class__name",
        "faculty_enrollment__faculty__name",
    )
    list_filter = ("faculty_enrollment", "facility_class_enrollment")
