from flask import request, redirect, url_for, render_template, flash, g
from flask_babel import gettext
from flask_login import login_required
from scss.database import db
from ..enrollment.models import TemporalHierarchy
from ..facility.models import Facility
from ..utils import generate_choices_from_list
from .forms import EditFacilityForm
from ..facility import facility

# Facility Related Routes    
@facility.route("/facilities/", methods=["GET"], strict_slashes=False)
def facility_list():
    """Renders a template to display a list of facilities.
    Returns:
        The rendered template for displaying the list of facilities.
    """

    return render_template("list.jinja2",
                            facilities=Facility.query().all(),
                            title="All Facilities")
    
@facility.route("/facilities/<int:facility_id>", methods=["GET"], strict_slashes=False)
def facility_detail(facility_id):
    """Renders a template to edit a specific facility.
    Args:
        facility_id: The ID of the facility to edit.
    Returns:
        The rendered template for editing the facility.
    """

    return render_template("facility/show.jinja2",
                            facility=Facility.query().filter(Facility.id == facility_id).first(),
                            title="Facility Details")
    
@facility.route("/facilities/<int:facility_id>/edit", methods=["GET", "POST"], strict_slashes=False)
def facility_edit(facility_id):
    pass

@facility.route("/factions/<int:facility_id>/delete", methods=["GET"], strict_slashes=False)
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

@facility.route("/facilities/<int:facility_id>/delete", methods=["POST"], strict_slashes=False)
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
    
@facility.route("/facilities/add", methods=["GET", "POST"], strict_slashes=False)
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

# facility_list

# facility_show

# facility_new

# facility_edit

# department_list

# department_show

# department_new

# department_edit

# quarters_list

# quarters_show

# quarters_new

# quarters_edit

# faculty_list

# faculty_show

# faculty_new

# faculty_edit
