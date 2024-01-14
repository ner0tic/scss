from django.shortcuts import render, redirect
from .forms import OrganizationForm
from django.core.exceptions import ValidationError

def create_organization(request):
    if request.method == 'POST':
        form = OrganizationForm(request.POST)
        if form.is_valid():
            try:
                form.save()
                return redirect('some_success_url')
            except ValidationError as e:
                form.add_error(None, e)
    else:
        form = OrganizationForm()
    
    return render(request, 'organizations/create.html', {'form': form})
