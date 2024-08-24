# facility/forms/facility.py
from django import forms
from ..models.facility import Facility


class FacilityForm(forms.ModelForm):
    class Meta:
        model = Facility
        fields = [
            "name",
            "description",
            "address",
            "organization",
            "is_active",
            "image",
        ]
