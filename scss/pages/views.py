from django.apps import apps
from django.http import HttpResponse, JsonResponse
from django.shortcuts import redirect, render, get_object_or_404
from django.contrib.auth.decorators import login_required
from django.views.decorators.csrf import csrf_exempt

from .models import Message, Notification, DashboardLayout
from .forms import MessageForm


@csrf_exempt
def save_layout(request):
    if request.method == "POST":
        layout = request.POST.get("layout")
        user = request.user
        DashboardLayout.objects.update_or_create(user=user, defaults={"layout": layout})
        return JsonResponse({"status": "success"})
    return JsonResponse({"status": "error"}, status=400)


@login_required
def mark_message_as_read(request, message_id):
    message = get_object_or_404(Message, id=message_id, receiver=request.user)
    message.read = True
    message.save()
    return redirect("inbox")


@login_required
def mark_notification_as_read(request, notification_id):
    notification = get_object_or_404(
        Notification, id=notification_id, user=request.user
    )
    notification.read = True
    notification.save()
    return redirect("notifications")


@login_required
def inbox(request):
    messages = Message.objects.filter(receiver=request.user).order_by("-timestamp")
    return render(request, "messaging/inbox.html", {"messages": messages})


@login_required
def sent_messages(request):
    messages = Message.objects.filter(sender=request.user).order_by("-timestamp")
    return render(request, "messaging/sent_messages.html", {"messages": messages})


@login_required
def send_message(request):
    if request.method == "POST":
        form = MessageForm(request.POST)
        if form.is_valid():
            message = form.save(commit=False)
            message.sender = request.user
            message.save()
            # Create a notification
            Notification.objects.create(
                user=message.receiver,
                message=message,
                content=f"New message from {request.user}",
            )
            return redirect("inbox")
    else:
        form = MessageForm()
    return render(request, "messaging/send_message.html", {"form": form})


@login_required
def notifications(request):
    notifications = Notification.objects.filter(user=request.user).order_by(
        "-timestamp"
    )
    return render(
        request, "messaging/notifications.html", {"notifications": notifications}
    )


def dynamic_dropdown_options(request, app_label, model_name, field_name, filter_value):
    Model = apps.get_model(app_label, model_name)
    filter_field_name = f"{field_name}__id"
    options = Model.objects.filter(**{filter_field_name: filter_value})
    response_data = [{"value": obj.pk, "text": str(obj)} for obj in options]
    return JsonResponse({"options": response_data})


def index(request):
    if request.user.is_authenticated:
        return redirect("dashboard")
    return render(request, "index.html")


def help(request, section=None):
    return render(request, "help.html", {"section": section})


def dynamic_css(request):
    css_content = """
    body {
        background-color: #f0f0f0;
        color: #333333;
    }
    /* More dynamic CSS content */
    """
    return HttpResponse(css_content, content_type="text/css")


def error_404(request, exception):
    return render(request, "errors/404.html", status=404)
