from flask import (
    current_app, request, redirect, url_for, render_template, flash, abort,
)
from flask_babel import gettext
from flask_login import login_user, login_required, logout_user
from itsdangerous import URLSafeSerializer, BadSignature
from scss.extensions import lm
from scss.jobs import send_registration_email
from scss.user.models import User
from scss.utils.models import Address
from scss.utils.forms import AddressAddForm
from scss.user.forms import RegisterUserForm
from .forms import LoginForm
from ..auth import auth


@lm.user_loader
def load_user(id):
    return User.get_by_id(int(id))


@auth.route('/login', methods=['GET', 'POST'])
def login():
    form = LoginForm()
    if form.validate_on_submit():
        login_user(form.user)
        flash(
            gettext(
                'You were logged in as {username}'.format(
                    username=form.user.username
                ),
            ),
            'success'
        )
        return redirect(request.args.get('next') or url_for('dashboard'))
    return render_template('login.jinja2', title='[SCSS] Login', form=form)


@auth.route('/logout', methods=['GET'])
@login_required
def logout():
    logout_user()
    flash(gettext('You were logged out'), 'success')
    return redirect(url_for('.login'))


@auth.route('/register', methods=['GET', 'POST'])
def register():
    form = RegisterUserForm(request.form)
    if form.validate_on_submit():
        print(form.data['address_id'])
        address = Address.create(
            line1=form.data['address_id']['line1'],
            line2=form.data['address_id']['line2'],
            city=form.data['address_id']['city'],
            state=form.data['address_id']['state'],
            postal_code=form.data['address_id']['postal_code'],
            country=form.data['address_id']['country'])
        
        user = User.create(
            username=form.data['username'],
            email=form.data['email'],
            password=form.data['password'],
            first_name = form.data['first_name'],
            last_name = form.data['last_name'],
            address_id = address.id,
            avatar_url = form.data['avatar_url'],
            role = form.data['role'],
            remote_addr=request.remote_addr,
        )

        s = URLSafeSerializer(current_app.secret_key)
        token = s.dumps(user.id)

        send_registration_email.queue(user.id, token)

        flash(
            gettext(
                'Sent verification email to {email}'.format(
                    email=user.email
                )
            ),
            'success'
        )
        return redirect(url_for('index'))
    return render_template('register.jinja2', form=form)


@auth.route('/verify/<token>', methods=['GET'])
def verify(token):
    s = URLSafeSerializer(current_app.secret_key)
    try:
        id = s.loads(token)
    except BadSignature:
        abort(404)

    user = User.query.filter_by(id=id).first_or_404()
    if user.active:
        abort(404)
    else:
        user.active = True
        user.update()

        flash(
            gettext(
                'Registered user {username}. Please login to continue.'.format(
                    username=user.username
                ),
            ),
            'success'
        )
        return redirect(url_for('auth.login'))