""" User Related Forms. """
from django import forms


class RegistrationForm(forms.Form):
    username = forms.CharField()
    email = forms.EmailField()
    password = forms.CharField(widget=forms.PasswordInput)
    first_name = forms.CharField()
    last_name = forms.CharField()
    user_type = forms.ChoiceField(
        choices=[("", "Select A Type"), ("Leader", "Leader"), ("Attendee", "Attendee"), ("Faculty", "Faculty")]
    )

