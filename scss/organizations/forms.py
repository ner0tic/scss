from django import forms
from .models import Organization

class OrganizationForm(forms.ModelForm):
    class Meta:
        model = Organization
        fields = ['name', 'abbreviation', 'description', 'parent']

    def clean(self):
        cleaned_data = super().clean()
        parent = cleaned_data.get("parent")

        # Check the depth
        depth = 0
        current = parent
        while current is not None:
            depth += 1
            if depth > 2:
                self.add_error('parent', "Maximum hierarchy depth exceeded")
            current = current.parent
