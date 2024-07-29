""" Faction Related Forms. """
from django import forms
from django.contrib.auth.forms import UserCreationForm

#from address.models import Address

from .models.attendee import Attendee, AttendeeProfile
from .models.leader import Leader, LeaderProfile
from .models.faction import Faction

class AttendeeProfileForm(forms.ModelForm):
    class Meta:
        model = AttendeeProfile
        fields = ['user', 'organization', 'faction']


class LeaderProfileForm(forms.ModelForm):
    class Meta:
        model = LeaderProfile
        fields = ['user', 'organization', 'faction']


class FactionForm(forms.ModelForm):
    class Meta:
        model = Faction
        fields = ['name', 'abbreviation', 'organization']




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
