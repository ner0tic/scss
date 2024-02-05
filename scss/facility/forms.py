""" Facility Related Forms. """
from address.models import Address
from django import forms
from django.contrib.auth.forms import UserCreationForm
from .models import Faculty, FacultyProfile


class FacultyProfileForm(forms.ModelForm):
    class Meta:
        model = FacultyProfile
        fields = ['facility', 'organization']  # 'address' is managed separately
        widgets = {
            'facility': forms.Select(),
            'organization': forms.Select(),
        }


class FacultyRegistrationForm(UserCreationForm):
    class Meta:
        model = Faculty
        fields = ("username", "email", "password1", "password2")
