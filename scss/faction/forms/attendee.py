# faction/forms/attendee.py
"""Attendee Related Forms."""

from django import forms

from ..models.attendee import AttendeeProfile


class AttendeeProfileForm(forms.ModelForm):
    class Meta:
        model = AttendeeProfile
        fields = []


class AttendeeForm(forms.ModelForm):
    user_username = forms.CharField(max_length=150)
    user_email = forms.EmailField()
    user_first_name = forms.CharField(max_length=30)
    user_last_name = forms.CharField(max_length=30)

    class Meta:
        model = AttendeeProfile
        fields = []

    def __init__(self, *args, **kwargs):
        super().__init__(*args, **kwargs)
        if self.instance and self.instance.pk:
            user = self.instance.user
            self.fields["user_username"].initial = user.username
            self.fields["user_email"].initial = user.email
            self.fields["user_first_name"].initial = user.first_name
            self.fields["user_last_name"].initial = user.last_name

    def save(self, commit=True):
        attendee_profile = super().save(commit=False)
        user = attendee_profile.user
        user.username = self.cleaned_data["user_username"]
        user.email = self.cleaned_data["user_email"]
        user.first_name = self.cleaned_data["user_first_name"]
        user.last_name = self.cleaned_data["user_last_name"]
        if commit:
            user.save()
            attendee_profile.save()
        return attendee_profile
