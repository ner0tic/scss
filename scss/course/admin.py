# course/admin.py

from django.contrib import admin
from .models import Course, Requirement
from taggit.models import Tag

class RequirementAdmin(admin.ModelAdmin):
    list_display = ('name', 'is_active', 'created_at')
    search_fields = ('name',)
    list_filter = ('is_active', )
    ordering = ('name',)
    prepopulated_fields = {'slug': ('name',)}

class CourseAdmin(admin.ModelAdmin):
    list_display = ('name', 'is_active', 'created_at')
    search_fields = ('name', 'tags__name')
    list_filter = ( 'is_active', )
    ordering = ('name',)
    filter_horizontal = ('requirements', 'prerequisites')#, 'tags')
    prepopulated_fields = {'slug': ('name',)}

    def get_queryset(self, request):
        queryset = super().get_queryset(request)
        queryset = queryset.prefetch_related('requirements', 'prerequisites')#, 'tags')
        return queryset

admin.site.register(Requirement, RequirementAdmin)
admin.site.register(Course, CourseAdmin)
