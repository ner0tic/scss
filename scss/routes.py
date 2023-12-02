"""Application routes."""
from datetime import datetime
from flask import current_app as app, render_template, request, redirect, url_for, make_response
from database import engine, session
from scss.models import User, Organization, Faction
from scss.forms import UserAddForm, OrganizationAddForm, FactionAddForm


# @login_manager.user_loader
def load_user(user_id):
    return User.query.get(int(user_id))

def generate_organization_children(organization_id):
    orgs = session.query(Organization).filter(Organization.parent_id == organization_id).all()
    if len(orgs) > 0:
        for org in orgs:
            org.children = generate_organization_children(org.id)
    return orgs

def generate_choices_from_list(options: list):
    choices = [(0, 'None')]
    choices += [(item.id, item.name) for item in options]
    return choices

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
def organization_list():
    return render_template("organization/list.jinja2",
                           organizations=session.query(Organization).all(),
                           title="All Organizations")
    
@app.route("/organizations/<int:organization_id>", methods=["GET"], strict_slashes=False)
def organization_detail(organization_id):
    org = session.query(Organization).filter(Organization.id==organization_id)
    print(org)
    return render_template("organization/show.jinja2",
                           organization=session.query(Organization).filter(Organization.id == organization_id).first(),
                           title="Organization Details")

@app.route("/organizations/<int:organization_id>/edit", methods=["GET", "POST"], strict_slashes=False)
def organization_edit(organization_id):
    pass

@app.route("/organizations/<int:organization_id>/delete", methods=["GET", "POST"], strict_slashes=False)
def organization_delete(organization_id):
    pass

@app.route("/organizations/add", methods=["GET", "POST"], strict_slashes=False)
def organization_add():
    organization = Organization()
    msg = None
    
    if request.method == "POST":
        form = OrganizationAddForm(request.form)
        form.organization_parent.choices = generate_choices_from_list(session.query(Organization).order_by('name'))
        form.organization_factions.choices = [(0, 'None')]
        
        # Check for unique organization name (at root level)
        if session.query(Organization).filter(
                Organization.name == form.name.data and Organization.parent_id is None
            ).first():
            msg = "An organization with that name already exists!"
            return render_template("organization/add.jinja2", form=form, msg=msg)
        
        # Validate the form data
        if form.validate():
            organization.name = form.organization_name.data
            organization.short_name = form.organization_short_name.data
            organization.description = form.organization_description.data
            organization.parent_id = form.organization_parent.data if form.organization_parent.data != 0 else None
            organization.factions = []
            
            session.add(organization)
            session.commit()
            msg = "Organization added successfully!"
            return render_template("organization/show.jinja2", organization=session.query(Organization).filter(Organization.name == organization.name and Organization.short_name == organization.short_name).first(), msg=msg)
    else:
        form = OrganizationAddForm(obj=organization)
        form.organization_parent.choices = generate_choices_from_list(session.query(Organization).order_by('name'))
        form.organization_factions.choices = [(0, 'None')]
    
    return render_template("organization/add.jinja2",
                           form=form,
                           title="Add Organization",
                           msg=msg)

@app.route("/factions/", methods=["GET"], strict_slashes=False)
def faction_list():
    return render_template("faction/list.jinja2",
                           factions=session.query(Faction).all(),
                           title="All Factions")
    
@app.route("/factions/<int:faction_id>", methods=["GET"], strict_slashes=False)
def faction_detail(faction_id):
    return render_template("faction/show.jinja2",
                           faction=session.query(Faction).filter(Faction.id == faction_id).first(),
                           title="Faction Details")
    
@app.route("/factions/<int:faction_id>/edit", methods=["GET", "POST"], strict_slashes=False)
def faction_edit(faction_id):
    pass

@app.route("/factions/<int:faction_id>/delete", methods=["GET", "POST"], strict_slashes=False)
def faction_delete(faction_id):
    pass

@app.route("/factions/add", methods=["GET", "POST"], strict_slashes=False)
def faction_add():
    faction = Faction()
    msg = None

    if request.method == "POST":
        form = FactionAddForm(request.form)
        form.organization_id.choices = generate_choices_from_list(session.query(Organization).order_by('name'))
        form.parent.choices = generate_choices_from_list(session.query(Faction).order_by('name'))
        
        if form.validate():
            # form.populate_obj(faction)
            faction.name = form.name.data
            faction.short_name = form.short_name.data
            faction.description = form.description.data
            faction.avatar_url = form.avatar_url.data
            faction.organization_id = form.organization_id.data
            faction.parent_id = form.parent.data if form.parent.data != 0 else None
            
            session.add(faction)
            session.commit()
            msg = "Faction added successfully!"
            return render_template("faction/show.jinja2", faction=session.query(Faction).filter(Faction.name == faction.name and Faction.short_name == faction.short_name).first(), msg=msg)
            
    else:
        form = FactionAddForm(obj=faction)
        form.organization_id.choices = generate_choices_from_list(session.query(Organization).order_by('name'))
        form.parent.choices = generate_choices_from_list(session.query(Faction).order_by('name'))
        

    return render_template("faction/add.jinja2", 
                           form=form,
                           title="Add Faction",
                           msg=msg)