# pages/mixins/forms.py

class FormValidMixin:
    def form_valid(self, form):
        if self.request.user.is_authenticated:
            form.instance.created_by = self.request.user
            form.instance.updated_by = self.request.user
        return super().form_valid(form)