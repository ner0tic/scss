# middleware.py
from django.utils.deprecation import MiddlewareMixin
from django.shortcuts import redirect

from enrollment.models.enrollment import ActiveEnrollment

class ActiveEnrollmentMiddleware:
    def __init__(self, get_response):
        self.get_response = get_response

    def __call__(self, request):
        if request.user.is_authenticated:
            if active_enrollment_id := request.session.get('active_enrollment_id'):
                request.active_enrollment = ActiveEnrollment.objects.get(id=active_enrollment_id)
            else:
                request.active_enrollment = ActiveEnrollment.objects.get(user_id=request.user.id)
        return self.get_response(request)


class BreadcrumbMiddleware(MiddlewareMixin):
    def process_template_response(self, request, response):
        if hasattr(response, 'context_data'):
            breadcrumbs = self.generate_breadcrumbs(request)
            response.context_data['breadcrumbs'] = breadcrumbs
        return response

    def generate_breadcrumbs(self, request):
        breadcrumbs = [{'name': 'Home', 'url': '/'}]
        path = request.path.strip('/').split('/')
        url = ''
        
        for segment in path:
            url += f'/{segment}'
            breadcrumbs.append({'name': segment.capitalize(), 'url': url})

        return breadcrumbs