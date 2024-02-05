""" Faction Related Views. """
from django.shortcuts import render, redirect
from django.contrib.auth import login, authenticate
from .forms import AttendeeRegistrationForm, LeaderRegistrationForm


def register_attendee(request):
    """Attendee Registration View."""
    if request.method == "POST":
        form = AttendeeRegistrationForm(request.POST)
        if form.is_valid():
            form.save()
            username = form.cleaned_data.get("username")
            raw_password = form.cleaned_data.get("password1")
            user = authenticate(username=username, password=raw_password)
            login(request, user)
            return redirect("home")  # Redirect to a home page or appropriate view
    else:
        form = AttendeeRegistrationForm()
    return render(request, "register_attendee.html", {"form": form})


def register_leader(request):
    """Leader Registration View."""
    if request.method == "POST":
        form = LeaderRegistrationForm(request.POST)
        if form.is_valid():
            form.save()
            username = form.cleaned_data.get("username")
            raw_password = form.cleaned_data.get("password1")
            user = authenticate(username=username, password=raw_password)
            login(request, user)
            return redirect("home")  # Redirect to a home page or appropriate view
    else:
        form = LeaderRegistrationForm()
    return render(request, "register_leader.html", {"form": form})
