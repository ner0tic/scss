# pages/mixins/views.py
from django.contrib.auth.mixins import PermissionRequiredMixin, UserPassesTestMixin, LoginRequiredMixin as BaseLoginRequiredMixin
from django.contrib.auth.models import User
from django.contrib import messages


class LoginRequiredMixin(BaseLoginRequiredMixin):
    login_url = '/login/'


class StaffRequiredMixin(UserPassesTestMixin):
    def test_func(self):
        return self.request.user.is_staff
    
    
class SuperUserRequired(UserPassesTestMixin):
    def test_func(self):
        return self.request.user.is_superuser


class FormMessagesMixin:
    success_message = ''
    error_message = ''

    def form_valid(self, form):
        response = super().form_valid(form)
        if self.success_message:
            messages.success(self.request, self.success_message)
        return response

    def form_invalid(self, form):
        response = super().form_invalid(form)
        if self.error_message:
            messages.error(self.request, self.error_message)
        return response


class ObjectPermissionRequiredMixin(PermissionRequiredMixin):
    def has_permission(self):
        obj = self.get_object()
        return self.request.user.has_perm(self.permission_required, obj)
