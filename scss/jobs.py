from flask import render_template
from flask_mail import Message

from scss.extensions import mail, rq
from scss.user.models import User


@rq.job
def send_registration_email(uid, token):
    """Sends a registratiion email to the given uid."""
    user = User.query.filter_by(id=uid).first()
    msg = Message(
        'User Registration',
        sender='admin@scss.com',
        recipients=[user.email]
    )
    msg.body = render_template(
        'mail/registration.mail',
        user=user,
        token=token
    )
    mail.send(msg)