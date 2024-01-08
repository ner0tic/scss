""" Database. """
import datetime
from flask import g
from flask_sqlalchemy import SQLAlchemy
from sqlalchemy import Column, DateTime, ForeignKey, Integer, or_, String
from sqlalchemy.ext.declarative import declared_attr
from sqlalchemy.orm import relationship
import sqlalchemy.types as types
from slugify import slugify

db = SQLAlchemy()

class CRUDMixin(object):
    """
    Class: CRUDMixin

    A mixin class that provides basic CRUD (Create, Read, Update, Delete) functionality for SQLAlchemy models.

    Methods:
        get_by_id(id) -> Optional[CRUDMixin]:
            Retrieves a model instance by its ID.
            Args:
                id: The ID of the model instance.
            Returns:
                The model instance with the specified ID, or None if not found.

        create(**kwargs) -> CRUDMixin:
            Creates a new model instance with the given attributes and saves it to the database.
            Args:
                Keyword arguments representing the attributes of the model instance.
            Returns:
                The created model instance.

        update(commit=True, **kwargs) -> CRUDMixin:
            Updates the attributes of the model instance with the given values.
            Args:
                commit: Whether to commit the changes to the database (default: True).
                Keyword arguments representing the attributes to be updated.
            Returns:
                The updated model instance.

        save(commit=True) -> CRUDMixin:
            Saves the model instance to the database.
            Args:
                commit: Whether to commit the changes to the database (default: True).
            Returns:
                The saved model instance.

        delete(commit=True) -> None:
            Deletes the model instance from the database.
            Args:
                commit: Whether to commit the changes to the database (default: True).
    """
    __table_args__ = {'extend_existing': True}

    id = Column(Integer, primary_key=True)

    @classmethod
    def get_by_id(cls, id):
        if any((isinstance(id, str) and id.isdigit(),
                isinstance(id, (int, float))),):
            return cls.query.get(int(id))
        return None

    @classmethod
    def create(cls, **kwargs):
        instance = cls(**kwargs)
        return instance.save()

    def update(self, commit=True, **kwargs):
        for attr, value in kwargs.items():
            setattr(self, attr, value)
        return commit and self.save() or self

    def save(self, commit=True):
        db.session.add(self)
        if commit:
            db.session.commit()
        return self

    def delete(self, commit=True):
        db.session.delete(self)
        return commit and db.session.commit()


class AuditMixin(object):
    """
    AuditMixin
    Mixin for models, adds 4 columns to stamp,
    time and user on creation and modification
    will create the following columns:

    :created on:
    :changed on:
    :created by:
    :changed by:
    """
    __table_args__ = {'extend_existing': True}

    created_on = Column(DateTime, default=lambda: datetime.datetime.now(), nullable=False)
    changed_on = Column(
        DateTime,
        default=lambda: datetime.datetime.now(),
        onupdate=lambda: datetime.datetime.now(),
        nullable=False,
    )

    @declared_attr
    def created_by_fk(cls):
        return Column(
            Integer, ForeignKey("user.id"), default=cls.get_user_id, nullable=False
        )

    @declared_attr
    def created_by(cls):
        return relationship(
            "User",
            primaryjoin = f"{cls.__name__}.created_by_fk == User.id",
            enable_typechecks=False,
        )

    @declared_attr
    def changed_by_fk(cls):
        return Column(
            Integer,
            ForeignKey("user.id"),
            default=cls.get_user_id,
            onupdate=cls.get_user_id,
            nullable=False,
        )

    @declared_attr
    def changed_by(cls):
        return relationship(
            "User",
            primaryjoin = f"{cls.__name__}.changed_by_fk == User.id",
            enable_typechecks=False,
        )

    @classmethod
    def get_user_id(cls):
        """
        Returns the ID of the current user.

        Returns:
            int or None: The ID of the current user if available, otherwise None.
        """
        try:
            return g.user.id
        except Exception:
            return None


class SlugMixin(object):
    slug = Column(String(255), unique=True, nullable=False)

    def __init__(self, *args, **kwargs):
        super().__init__(*args, **kwargs)
        self.slug = self.generate_slug()

    def generate_slug(self):
        return slugify(self.name)

class UserSlugMixin(SlugMixin):
    def generate_slug(self):
        return slugify(self.first_name + ' ' + self.last_name)

class BaseMixin(object):
    _repr_hide = ['created_at', 'updated_at', 'slug']
    
    id = Column(Integer, primary_key=True)

    def __repr__(self):
        values = ', '.join(f"{n}={getattr(self, n)}" for n in self.__table__.c.keys() if n not in self._repr_hide)
        return f"{self.__class__.__name__}({values})"

    def filter_string(self):
        return self.__str__()



class DataTable(object):
    """
    Represents a sortable, filterable, searchable, and paginated set of data,
    generated by arguments in the request values.

    TODO:
    - flask-ext for access to request values?
    - throw some custom errors when getting fields, etc
    - get rid of the 4 helpers that do the same thing
    - should this generate some html to help with visualizing the data?
    """
    def __init__(self, model, columns, sortable, searchable, filterable, limits, request):
        self.model = model
        self.query = self.model.query
        self.columns = columns
        self.sortable = sortable
        self.orders = ['asc', 'desc']
        self.searchable = searchable
        self.filterable = filterable
        self.limits = limits

        self.get_selected(request)

        for f in self.filterable:
            self.selected_filter = request.values.get(f.name, None)
            self.filter(f.name, self.selected_filter)
        self.search(self.selected_query)
        self.sort(self.selected_sort, self.selected_order)
        self.paginate(self.selected_page, self.selected_limit)

    def get_selected(self, request):
        self.selected_sort = request.values.get('sort', self.sortables[0])
        self.selected_order = request.values.get('order', self.orders[0])
        self.selected_query = request.values.get('query', None)
        self.selected_limit = request.values.get('limit', self.limits[1], type=int)
        self.selected_page = request.values.get('page', 1, type=int)

    @property
    def _columns(self):
        return [x.name for x in self.columns]

    @property
    def sortables(self):
        return [x.name for x in self.sortable]

    @property
    def searchables(self):
        return [x.name for x in self.searchable]

    @property
    def filterables(self):
        return [x.name for x in self.filterable]

    @property
    def colspan(self):
        """Length of all columns."""
        return len(self.columns) + len(self.sortable) + len(self.searchable)

    def sort(self, field, order):
        """Sorts the data based on a field & order."""
        if field in self.sortables and order in self.orders:
            field = getattr(getattr(self.model, field), order)
            self.query = self.query.order_by(field())

    def filter(self, field, value):
        """Filters the query based on a field & value."""
        if field and value:
            field = getattr(self.model, field)
            self.query = self.query.filter(field=value)

    def search(self, search_query):
        """Filters the query based on a list of fields & search query."""
        if search_query:
            search_query = '%%%s%%' % search_query
            fields = [getattr(self.model, x) for x in self.searchables]
            self.query = self.query.filter(or_(*[x.like(search_query) for x in fields]))

    def paginate(self, page, limit):
        """Paginate the query based on a page & limit."""
        self.query = self.query.paginate(page=page, per_page=limit)
