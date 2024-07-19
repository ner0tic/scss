# middleware.py
from django.shortcuts import redirect
from ..enrollment.models import ActiveEnrollment

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

