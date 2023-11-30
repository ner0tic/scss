"""Application routes."""
from datetime import datetime
from flask import current_app as app, render_template, request, redirect, url_for, make_response
from database import engine, session
from scss.models import User, Organization


# @login_manager.user_loader
def load_user(user_id):
    return User.query.get(int(user_id))

# app = create_app()
@app.route("/users/", methods=("GET", "POST"), strict_slashes=False)
def user_records():
    print('entering user_records')  
    """Create a user via query string parameters."""
    username = request.args.get("user")
    email = request.args.get("email")
    if username and email:
        if existing_user := User.query.filter(
            User.username == username or User.email == email
        ).first():
            return make_response(f"{username} ({email}) already created!")
        new_user = User(
            username=username,
            email=email,
            created=datetime.now(),
            bio="In West Philadelphia born and raised, \
            on the playground is where I spent most of my days",
            admin=False,
        )  # Create an instance of the User class
        session.add(new_user)  # Adds new User record to database
        session.commit()  # Commits all changes
        redirect(url_for("user_records"))
    return render_template("users.jinja2", users=session.query(User).all(), title="All Users")

@app.route("/organizations/", methods=["GET"], strict_slashes=False)
def organization_records():
    print('entering organization_records')
    """Create a user via query string parameters."""
    organization_name = request.args.get("organization_name")
    if organization_name:
        if existing_organization := Organization.query.filter(
            Organization.organization_name == organization_name
        ).first():
            return make_response(f"{organization_name} already created!")
        new_organization = Organization(
            organization_name=organization_name,
            created=datetime.now(),
            admin=False,
        )  # Create an instance of the User class
        session.add(new_organization)  # Adds new User record to database
        session.commit()  # Commits all changes
        redirect(url_for("organization_records"))
    return render_template("organizations.jinja2", organizations=session.query(Organization).all(), title="All Organizations")