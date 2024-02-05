from django.contrib import admin
from .models import Course, Requirement

@admin.register(Requirement)
class RequirementAdmin(admin.ModelAdmin):
    list_display = ('name',)
    search_fields = ('name',)
    exclude = ('slug',)

@admin.register(Course)
class CourseAdmin(admin.ModelAdmin):
    list_display = ('name',)
    search_fields = ('name',)
    filter_horizontal = ('requirements',)
    exclude = ('slug',)

    def get_queryset(self, request):
        queryset = super().get_queryset(request)
        queryset = queryset.prefetch_related('requirements')
        return queryset
