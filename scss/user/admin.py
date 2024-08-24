# user/admin.py

from django.contrib import admin
from django.contrib.auth.admin import UserAdmin as BaseUserAdmin
from django.utils.translation import gettext_lazy as _

from faction.models import AttendeeProfile
from faction.models.leader import LeaderProfile
from facility.models.faculty import FacultyProfile

from .models import User


class FacultyProfileInline(admin.StackedInline):
    model = FacultyProfile
    can_delete = False
    verbose_name_plural = "Faculty Profile"


class LeaderProfileInline(admin.StackedInline):
    model = LeaderProfile
    can_delete = False
    verbose_name_plural = "Leader Profile"


class AttendeeProfileInline(admin.StackedInline):
    model = AttendeeProfile
    can_delete = False
    verbose_name_plural = "Attendee Profile"


class UserAdmin(BaseUserAdmin):
    list_display = (
        "username",
        "email",
        "first_name",
        "last_name",
        "user_type",
        "is_admin",
    )
    list_filter = ("user_type", "is_admin", "is_active")
    search_fields = ("username", "email", "first_name", "last_name")
    ordering = ("username",)

    fieldsets = (
        (None, {"fields": ("username", "password")}),
        (_("Personal info"), {"fields": ("first_name", "last_name", "email")}),
        (
            _("Permissions"),
            {
                "fields": (
                    "is_active",
                    "is_staff",
                    "is_superuser",
                    "groups",
                    "user_permissions",
                )
            },
        ),
        (_("Important dates"), {"fields": ("last_login", "date_joined")}),
        (_("User Type"), {"fields": ("user_type", "is_admin")}),
    )

    # Dynamically add the appropriate inline based on user_type
    def get_inlines(self, request, obj):
        inlines = []
        if obj is not None:  # Ensure obj exists
            if obj.user_type == "FACULTY":
                inlines = [FacultyProfileInline]
            elif obj.user_type == "LEADER":
                inlines = [LeaderProfileInline]
            elif obj.user_type == "ATTENDEE":
                inlines = [AttendeeProfileInline]
        return inlines


admin.site.register(User, UserAdmin)
