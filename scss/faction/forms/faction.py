""" Faction Related Forms. """

from django import forms
from django.contrib.auth.forms import UserCreationForm

# from address.models import Address
from user.forms import UserForm

from ..models.attendee import Attendee, AttendeeProfile
from ..models.leader import Leader, LeaderProfile
from ..models.faction import Faction


class FactionForm(forms.ModelForm):
    class Meta:
        model = Faction
        fields = ["name", "abbreviation", "organization"]
