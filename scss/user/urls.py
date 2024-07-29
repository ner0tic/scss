# user/urls.py

from django.urls import path

from . import views

urlpatterns = [
    path("login", views.LoginView.as_view(), name="login"),
    path("signin", views.LoginView.as_view(), name="signin"),
    path("register", views.RegisterView.as_view(), name="register"),
    path("signup", views.RegisterView.as_view(), name="signup"),
    path("dashboard", views.DashboardView.as_view(), name="dashboard"),
    path("logout", views.LogoutView.as_view(), name="logout"),
    path("signout", views.LogoutView.as_view(), name="signout"),
    path("account", views.SettingsView.as_view(), name="account_settings"),
]
