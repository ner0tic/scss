""" Faction Related Forms. """
from address.models import Address
from .models import Attendee, Leader, AttendeeProfile, LeaderProfile
from django import forms
from django.contrib.auth.forms import UserCreationForm


class AttendeeProfileForm(forms.ModelForm):
    class Meta:
        model = AttendeeProfile
        fields = ['faction', 'organization']  # 'address' is managed separately
        widgets = {
            'faction': forms.Select(),
            'organization': forms.Select(),
        }


class LeaderProfileForm(forms.ModelForm):
    class Meta:
        model = LeaderProfile
        fields = ['faction', 'organization']  # 'address' is managed separately
        widgets = {
            'faction': forms.Select(),
            'organization': forms.Select(),
        }




class AttendeeCreationForm(UserCreationForm):
    class Meta:
        model = Attendee
        fields = ("username", "email", "password1", "password2")


class AttendeeRegistrationForm(UserCreationForm):
    class Meta:
        model = Attendee
        fields = ("username", "email", "password1", "password2")


class LeaderRegistrationForm(UserCreationForm):
    class Meta:
        model = Leader
        fields = ("username", "email", "password1", "password2")
