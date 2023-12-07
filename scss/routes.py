"""Application routes."""
from datetime import datetime
from flask import current_app as app, render_template, request, redirect, url_for, make_response
from sqlalchemy import and_
from flask_login import login_user, logout_user
from database import session
import scss.models as models
import scss.forms as forms

# Creates a user loader callback that returns the user object given an id
# @login_manager.user_loader
def loader_user(user_id):
	return session.query(models.User).get(user_id)

@app.route("/")
def home():
	# Render home.html on "/" route
	return render_template("home.jinja2", title="Summer Camp Scheduling System", current_user=None)

@app.route("/login", methods=["GET", "POST"])
def login():
    form = forms.LoginForm(request.form)
    if request.method == "POST":
        user = session.query(models.User).filter_by(
            username=request.form.get("username")).first()
        if user.password == request.form.get("password"):
            login_user(user)
            return redirect(url_for("home"))
    return render_template("login.jinja2", title="Login", form=form)

@app.route("/logout", methods=["GET", "POST"])
def logout():
    logout_user()
    return redirect(url_for("home"))

@app.route('/register', methods=["GET", "POST"])
def register():
    form = forms.RegistrationForm(request.form)
    if request.method == "POST":
        user = models.User(
                username=request.form.get("username"),
                password=request.form.get("password"),
                email=request.form.get("email"),
                created=datetime.now(),
                avatar_url=request.form.get("avatar_url"),
                first_name=request.form.get("first_name"),
                last_name=request.form.get("last_name"),
                role=request.form.get("role"))
                
		# Add the user to the database
        session.add(user)
        session.commit()
		
        return redirect(url_for("login"))
    return render_template("register.jinja2", title="Register", form=form)

def generate_organization_children(organization_id: int) -> list:
    """Generates a list of child organizations for a given organization ID.
    Args:
        organization_id: The ID of the organization to generate children for.
    Returns:
        A list of child organizations for the given organization ID.
    """

    orgs = session.query(models.Organization).filter(models.Organization.parent_id == organization_id).all()
    if orgs:
        for org in orgs:
            org.children = generate_organization_children(org.id)
    return orgs

def generate_choices_from_list(options: list):
    """Generates a list of choices from a given list of options.
    Args:
        options: A list of options.

    Returns:
        A list of choices in the format [(id, name), ...].
    """

    return [(0, 'None')] + [(item.id, item.name) for item in options]

# User Related Routes
@app.route("/users/", methods=("GET", "POST"), strict_slashes=False)
def user_records():
    """Create a user via query string parameters."""
    username = request.args.get("user")
    email = request.args.get("email")
    if username and email:
        if existing_user := models.User.query.filter(
            models.User.username == username or models.User.email == email
        ).first():
            return make_response(f"{username} ({email}) already created!")
        new_user = models.User(
            username=username,
            email=email,
            created=datetime.now(),
        )  # Create an instance of the User class
        session.add(new_user)  # Adds new User record to database
        session.commit()  # Commits all changes
        redirect(url_for("user_records"))
    return render_template("users.jinja2", users=session.query(models.User).all(), title="All Users")

# Organization Related Routes
@app.route("/organizations/", methods=["GET"], strict_slashes=False)
def organization_list():
    """Renders a template to display a list of organizations.
    Returns:
        The rendered template for displaying the list of organizations.
    """

    return render_template("organization/list.jinja2",
                            organizations=session.query(models.Organization).all(),
                            title="All Organizations")
    
@app.route("/organizations/<int:organization_id>", methods=["GET"], strict_slashes=False)
def organization_show(organization_id):
    """Renders a template to display the details of a specific organization.
    Args:
        organization_id: The ID of the organization to display.
    Returns:
        The rendered template for displaying the organization details.
    """

    return render_template("organization/show.jinja2",
                            organization=session.query(models.Organization).filter(models.Organization.id == organization_id).first(),
                            title="Organization Details")

@app.route("/organizations/<int:organization_id>/edit", methods=["GET", "POST"], strict_slashes=False)
def organization_edit(organization_id):
    # @TODO: Implement organization editing
    pass

@app.route("/organizations/<int:organization_id>/delete", methods=["GET", "POST"], strict_slashes=False)
def organization_delete(organization_id):
    """Renders a template to delete an organization based on the provided organization ID.
    Args:
        organization_id: The ID of the organization to delete.
    Returns:
        The rendered template for deleting the organization.
    Raises:
        None.
    """

    msg = None
    form = forms.DeleteConfirmationForm(request.form)
    form.id = organization_id
    
    if request.method == "POST" and form.validate():
        if form.confirm.data:
            # Remove all child organizations, factions, attendees, enrollments, and events
            # @todo: implement removal of all child-related objects
            # Remove Organization
            session.query(models.Organization).filter(models.Organization.id == organization_id).delete()
            session.commit()
            msg = "Organization deleted successfully!"
        else:
            msg = "Organization deletion cancelled!"

        organizations = session.query(models.Organization).all()
        return render_template("organization/list.jinja2",
                                organizations=organizations,
                                title="All Organizations",
                                msg=msg)

    organization = session.query(models.Organization).filter(models.Organization.id == organization_id).first()
    return render_template("delete.jinja2",
                            organization=organization,
                            form=form,
                            title="Delete Organization",
                            msg=msg)
    
@app.route("/organizations/add", methods=["GET", "POST"], strict_slashes=False)
def organization_add():
    """Renders a template to add a new organization.
    Returns:
        The rendered template for adding a new organization.
    """

    organization = models.Organization()
    msg = None

    def set_form_choices(form):
        """Sets the choices for the organization parent and factions in a given form.
        Args:
            form: The form to set the choices for.
        Returns:
            None.
        """

        form.organization_parent.choices = generate_choices_from_list(session.query(models.Organization).order_by('name'))
        form.organization_factions.choices = generate_choices_from_list([])

    if request.method == "POST":
        form = forms.OrganizationAddForm(request.form)
        set_form_choices(form)

        # Check for unique organization name (at root level)
        if session.query(Organization).filter(
                and_(models.Organization.name == form.name.data, models.Organization.parent_id == None)
            ).first():
            msg = "An organization with that name already exists!"
            return render_template("organization/add.jinja2", form=form, msg=msg)

        # Validate the form data
        if form.validate():
            organization.name = form.organization_name.data
            organization.short_name = form.organization_short_name.data
            organization.description = form.organization_description.data
            organization.parent_id = None if form.organization_parent.data == 0 else form.organization_parent.data
            organization.factions = []

            session.add(organization)
            session.commit()
            msg = "Organization added successfully!"
            return render_template("organization/show.jinja2", organization=organization, msg=msg)
    else:
        form = forms.OrganizationAddForm(obj=organization)
        set_form_choices(form)

    return render_template("organization/add.jinja2",
                            form=form,
                            title="Add Organization",
                            msg=msg)

# Faction Related Routes
@app.route("/factions/", methods=["GET"], strict_slashes=False)
def faction_list():
    """Renders a template to display a list of factions.
    Returns:
        The rendered template for displaying the list of factions.
    Raises:
        None.
    """

    return render_template("faction/list.jinja2",
                            factions=session.query(models.Faction).all(),
                            title="All Factions")
    
@app.route("/factions/<int:faction_id>", methods=["GET"], strict_slashes=False)
def faction_detail(faction_id):
    """Renders a template to display the details of a specific faction.
        Args:
            faction_id: The ID of the faction to display.

        Returns:
            The rendered template for displaying the faction details.
    """

    return render_template("faction/show.jinja2",
                            faction=session.query(models.Faction).filter(models.Faction.id == faction_id).first(),
                            title="Faction Details")
    
@app.route("/factions/<int:faction_id>/edit", methods=["GET", "POST"], strict_slashes=False)
def faction_edit(faction_id):
    pass

@app.route("/factions/<int:faction_id>/delete", methods=["GET"], strict_slashes=False)
def faction_delete_get(faction_id):
    """Handles the GET request to display the delete confirmation page for a faction.
    Args:
        faction_id: The ID of the faction to delete.
    Returns:
        The rendered template for the delete confirmation page.

    """

    form = forms.DeleteConfirmationForm(request.form)
    form.id = faction_id
    return render_template("delete.jinja2",
                            faction=session.query(models.Faction).filter(models.Faction.id == faction_id).first(),
                            form=form,
                            title="Delete Faction")

@app.route("/factions/<int:faction_id>/delete", methods=["POST"], strict_slashes=False)
def faction_delete_post(faction_id):
    """Handles the POST request to delete a faction.
    Args:
        faction_id: The ID of the faction to delete.
    Returns:
        The rendered template for displaying the list of factions after deletion.
    """

    form = forms.DeleteConfirmationForm(request.form)
    form.id = faction_id
    if not form.validate() or not form.confirm.data:
        msg = "Faction deletion cancelled!"
        return render_template("faction/list.jinja2",
                                factions=session.query(models.Faction).all(),
                                title="All Factions",
                                msg=msg)

    # Remove all child factions, attendees, enrollments, and events
    # @todo: implement removal of all child-related objects
    # Remove Faction
    session.query(models.Faction).filter(models.Faction.id == faction_id).delete()
    session.commit()
    msg = "Faction deleted successfully!"
    return render_template("faction/list.jinja2",
                           factions=session.query(models.Faction).all(),
                           title="All Factions",
                           msg=msg)

@app.route("/factions/add", methods=["GET", "POST"], strict_slashes=False)
def faction_add():
    """Renders a template to add a new faction.
    Returns:
        The rendered template for adding a new faction.
    """

    faction = models.Faction()
    msg = None
    form = forms.FactionAddForm(request.form) if request.method == "POST" else forms.FactionAddForm(obj=faction)
    form.organization_id.choices = generate_choices_from_list(session.query(models.Organization).order_by('name'))
    form.parent.choices = generate_choices_from_list(session.query(models.Faction).order_by('name'))

    if request.method == "POST" and form.validate():
        faction.name = form.name.data
        faction.short_name = form.short_name.data
        faction.description = form.description.data
        faction.avatar_url = form.avatar_url.data
        faction.organization_id = form.organization_id.data
        faction.parent_id = form.parent.data if form.parent.data != 0 else None

        session.add(faction)
        session.commit()
        msg = "Faction added successfully!"
        added_faction = session.query(models.Faction).filter(models.Faction.name == faction.name, models.Faction.short_name == faction.short_name).first()
        return render_template("faction/show.jinja2", faction=added_faction, msg=msg)

    return render_template("faction/add.jinja2", 
                            form=form,
                            title="Add Faction",
                            msg=msg)

# Facility Related Routes    
@app.route("/facilities/", methods=["GET"], strict_slashes=False)
def facility_list():
    """Renders a template to display a list of facilities.
    Returns:
        The rendered template for displaying the list of facilities.
    """

    return render_template("facility/list.jinja2",
                            facilities=session.query(models.Facility).all(),
                            title="All Facilities")
    
@app.route("/facilities/<int:facility_id>", methods=["GET"], strict_slashes=False)
def facility_detail(facility_id):
    """Renders a template to edit a specific facility.
    Args:
        facility_id: The ID of the facility to edit.
    Returns:
        The rendered template for editing the facility.
    """

    return render_template("facility/show.jinja2",
                            facility=session.query(models.Facility).filter(models.Facility.id == facility_id).first(),
                            title="Facility Details")
    
@app.route("/facilities/<int:facility_id>/edit", methods=["GET", "POST"], strict_slashes=False)
def facility_edit(facility_id):
    pass

@app.route("/factions/<int:facility_id>/delete", methods=["GET"], strict_slashes=False)
def facility_delete_get(facility_id):
    """Handles the GET request to display the delete confirmation page for a facility.
    Args:
        facility_id: The ID of the facility to delete.
    Returns:
        The rendered template for the delete confirmation page.

    """

    form = forms.DeleteConfirmationForm(request.form)
    form.id = facility_id
    
    return render_template("delete.jinja2",
                            facility=session.query(models.Facility).filter(models.Facility.id == facility_id).first(),
                            form=form,
                            title="Delete Facility")

@app.route("/facilities/<int:facility_id>/delete", methods=["POST"], strict_slashes=False)
def facility_delete_post(facility_id):
    """Handles the POST request to delete a facility.
    Args:
        facility_id: The ID of the facility to delete.
    Returns:
        The rendered template for displaying the list of facilities after deletion.
    """
    
    form = forms.DeleteConfirmationForm(request.form)
    form.id = facility_id
    if not form.validate() or not form.confirm.data:
        msg = "Facility deletion cancelled!"
        return render_template("facility/list.jinja2",
                                facilities=session.query(models.Facility).all(),
                                title="All Facilities",
                                msg=msg)
        
    # Remove all child facilities, attendees, enrollments, and events
    # @todo: implement removal of all child-related objects
    # Remove Facility
    session.query(models.Facility).filter(models.Facility.id == facility_id).delete()
    session.commit()
    msg = "Facility deleted successfully!"
    return render_template("facility/list.jinja2",
                            facilities=session.query(models.Facility).all(),
                            title="All Facilities",
                            msg=msg)
    
@app.route("/facilities/add", methods=["GET", "POST"], strict_slashes=False)
def facility_add():
    """

Renders a template to add a new facility.

Returns:
    The rendered template Renders a template for adding a to add a new facility.

new facility.

Raises:
    Returns:
    None.
"""

    facility = models.Facility()
    address = models.Address()
    msg = None

    if request.method == "POST":
        form = forms.FacilityAddForm(request.form)
        form.organization_id.choices = generate_choices_from_list(session.query(models.Organization).order_by('name'))
        #address_form = forms.AddressAddForm(form.address_id.form)
        
        if form.validate():
            facility.name = form.name.data
            facility.description = form.description.data
            facility.avatar = form.avatar.data
            facility.organization_id = form.organization_id.data
            
            address = models.Address(
                #name = form.address_id.name,
                line1 = form.address_id.line1.data,
                line2 = form.address_id.line2.data,
                city = form.address_id.city.data,
                state = form.address_id.state.data,
                postal_code = form.address_id.postal_code.data,
                country = form.address_id.country.data)
                
            session.add(address)
            session.commit()
            session.flush()
            
            facility.address_id = session.query(models.Address).filter(models.Address.line1 == address.line1 and models.Address.city == address.city and models.Address.state == address.state and models.Address.postal_code == address.postal_code).first().id 
            session.add(facility)
            session.commit()
            
            msg = "Facility added successfully!"
            return render_template("facility/show.jinja2", facility=session.query(models.Facility).filter(models.Facility.name == facility.name).first(), msg=msg)
            
    else:
        form = forms.FacilityAddForm(obj=facility)
        form.organization_id.choices = generate_choices_from_list(session.query(models.Organization).order_by('name'))
        form.address_id.label = "Address"
        
    return render_template("facility/add.jinja2", 
                            form=form,
                            title="Add Facility",
                            msg=msg)
