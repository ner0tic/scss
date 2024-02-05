""" Address Related Forms. """
from django import forms
from .models import Address

class AddressForm(forms.ModelForm):
    class Meta:
        model = Address
        fields = ['street', 'street2', 'city', 'state', 'zip_code', 'country']
