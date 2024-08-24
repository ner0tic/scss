# facility/forms/faculty.py
"""Faculty Related Forms."""

from django import forms

from enrollment.models.facility import FacilityClass
from user.models import User

from ..models.faculty import FacultyProfile
from ..models.quarters import Quarters
from ..models.department import Department


class FacultyProfileForm(forms.ModelForm):
    class Meta:
        model = FacultyProfile
        fields = []


class FacultyForm(forms.ModelForm):
    user_username = forms.CharField(max_length=150)
    user_email = forms.EmailField()
    user_first_name = forms.CharField(max_length=30)
    user_last_name = forms.CharField(max_length=30)
    user_is_admin = forms.BooleanField()

    class Meta:
        model = FacultyProfile
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
        faculty_profile = super().save(commit=False)
        user = faculty_profile.user
        user.username = self.cleaned_data["user_username"]
        user.email = self.cleaned_data["user_email"]
        user.first_name = self.cleaned_data["user_first_name"]
        user.last_name = self.cleaned_data["user_last_name"]
        if commit:
            user.save()
            faculty_profile.save()
        return faculty_profile


class RegistrationForm:
    pass


class PromoteFacultyForm(forms.ModelForm):
    """
    Form for promoting a faculty member to an admin role.
    """

    class Meta:
        model = User
        fields = ["is_admin"]
        widgets = {
            "is_admin": forms.CheckboxInput(attrs={"class": "form-control"}),
        }


class AssignDepartmentForm(forms.ModelForm):
    """
    Form for assigning a faculty member to a department.
    """

    department = forms.ModelChoiceField(
        queryset=Department.objects.all(),
        widget=forms.Select(attrs={"class": "form-control"}),
    )

    class Meta:
        model = FacultyProfile
        fields = ["department"]


class AssignClassForm(forms.ModelForm):
    """
    Form for assigning a faculty member to a class.
    """

    facility_class = forms.ModelChoiceField(
        queryset=FacilityClass.objects.all(),
        widget=forms.Select(attrs={"class": "form-control"}),
    )

    class Meta:
        model = FacultyProfile
        fields = ["facility_class"]


class ChangeQuartersForm(forms.ModelForm):
    """
    Form for changing the quarters assigned to a faculty member.
    """

    quarters = forms.ModelChoiceField(
        queryset=Quarters.objects.all(),
        widget=forms.Select(attrs={"class": "form-control"}),
    )

    class Meta:
        model = FacultyProfile
        fields = ["quarters"]
