from django.shortcuts import render, redirect
from django.apps import apps
from django.http import JsonResponse, HttpResponse


def dynamic_dropdown_options(request, app_label, model_name, field_name, filter_value):
    Model = apps.get_model(app_label, model_name)
    filter_field_name = f"{field_name}__id"
    options = Model.objects.filter(**{filter_field_name: filter_value})
    response_data = [{'value': obj.pk, 'text': str(obj)} for obj in options]
    return JsonResponse({'options': response_data})


def index(request):
    if request.user.is_authenticated:
        return redirect('dashboard')
    return render(request, 'index.html')

def about(request):
    return render(request, 'about.html')

def help(request):
    return render(request, 'help.html')


def dynamic_css(request):
    css_content = """
    body {
        background-color: #f0f0f0;
        color: #333333;
    }
    /* More dynamic CSS content */
    """
    return HttpResponse(css_content, content_type='text/css')