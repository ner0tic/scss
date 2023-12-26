""" Course forms. """
from flask_wtf import FlaskForm
from wtforms import StringField, SubmitField, SelectField, TextAreaField, HiddenField
from wtforms.validators import InputRequired

class CourseForm(FlaskForm):
    """Form for editing a course.

    This form provides fields for editing the name, short name, description, 
    avatar URL, and parent of a course.

    Args:
        name (str): The name of the course.
        short_name (str, optional): The short name of the course.
        description (str): The description of the course.
        avatar_url (str, optional): The URL of the course's avatar image.
        parent (int): The ID of the parent course.
    
    Attributes:
        name (StringField): The field for editing the name of the course.
        short_name (StringField): The field for editing the short name of the course.
        description (TextAreaField): The field for editing the description of the course.
        avatar_url (StringField): The field for editing the avatar URL of the course.
        parent (SelectField): The field for selecting the parent course.
        submit (SubmitField): The field for submitting the form.
    """

    name = StringField('Name', validators=[InputRequired()])
    short_name = StringField('Short Name')
    description = TextAreaField('Description', validators=[InputRequired()])
    avatar_url = StringField('Avatar URL')
    parent = SelectField('Parent', coerce=int, validators=[InputRequired('Parent required!')])

    submit = SubmitField('Submit')

class RequirementForm(FlaskForm):
    """ Form for editing a requirement.

        This form provides fields for editing the name, description, parent, avatar URL, course type, and parent ID of a requirement.

        Args:
            name (str): The name of the requirement.
            description (str): The description of the requirement.
            parent (int): The ID of the parent requirement.
            avatar_url (str, optional): The URL of the requirement's avatar image.
            course_type (str): The type of the requirement.
            parent_id (int): The ID of the parent requirement.
        
        Attributes:
            name (StringField): The field for editing the name of the requirement.
            description (TextAreaField): The field for editing the description of the requirement.
            parent (SelectField): The field for selecting the parent requirement.
            avatar_url (StringField): The field for editing the avatar URL of the requirement.
            course_type (HiddenField): The hidden field for storing the course type of the requirement.
            parent_id (SelectField): The field for selecting the parent requirement ID.
            submit (SubmitField): The field for submitting the form.
    """

    name = StringField('Name', validators=[InputRequired()])
    description = TextAreaField('Description', validators=[InputRequired()])
    parent = SelectField('Parent', coerce=int, validators=[InputRequired('Parent required!')])
    avatar_url = StringField('Avatar URL')
    course_type = HiddenField(default='course')
    parent_id = SelectField('Parent ID',
                            coerce=int,
                            validators=[InputRequired('Parent ID required!')])
    submit = SubmitField('Submit')
