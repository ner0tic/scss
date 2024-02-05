from django.urls import path
from . import views

urlpatterns = [
    path('login', views.login_view, name='login'),
    path('signin', views.login_view, name='signin'),
    path('register', views.register, name='register'),
    path('signup', views.register, name='signup'),
    path('dashboard', views.dashboard, name='dashboard'),
    path('logout', views.logout, name='logout'),
    path('signout', views.logout, name='signout'),
    path('account', views.settings, name='account_settings'),
]