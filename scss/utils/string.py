""" String Utils. """
from itertools import chain
from enum import Enum
import inspect
from sqlalchemy import ForeignKeyConstraint

def format_repr(obj, *args, **kwargs):
    """
    Create a pretty repr string from object attributes.

    :param obj: The object to show the repr for.
    :param args: The names of arguments to include in the repr.
                The arguments are shown in order using their unicode
                representation.
    :param kwargs: Each kwarg is included as a ``name=value`` string
                if it doesn't match the provided value.  This is
                mainly intended for boolean attributes such as
                ``is_deleted`` where you don't want them to
                clutter the repr unless they are set.
    :param _text: When the keyword argument `_text` is provided and
                not ``None``, it will include its value as extra
                text in the repr inside quotes.  This is useful
                for objects which have one longer title or text
                that doesn't look well in the unquoted
                comma-separated argument list.
    :param _rawtext: Like `_text` but without surrounding quotes.
    :param _repr: Similar as `_text`, but uses the `repr()` of the
                passed object instead of quoting it.  Cannot be
                used together with `_text`.
    """

    def _format_value(value):
        return value.name if isinstance(value, Enum) else value

    text_arg = kwargs.pop("_text", None)
    raw_text_arg = kwargs.pop("_rawtext", None)
    repr_arg = kwargs.pop("_repr", None)
    cls = type(obj)
    obj_name = cls.__name__
    fkeys = (
        set(
            chain.from_iterable(
                c.column_keys
                for t in inspect.inspect(cls).tables
                for c in t.constraints
                if isinstance(c, ForeignKeyConstraint)
            )
        )
        if hasattr(cls, "__table__")
        else set()
    )
    formatted_args = [
        str(_format_value(getattr(obj, arg)))
        if arg not in fkeys
        else f"{arg}={_format_value(getattr(obj, arg))}"
        for arg in args
    ]
    for name, default_value in sorted(kwargs.items()):
        value = getattr(obj, name)
        if value != default_value:
            formatted_args.append(f"{name}={_format_value(value)}")
    if text_arg is not None:
        return '<{obj_name}({", ".join(formatted_args)}): "{text_arg}">'
    elif raw_text_arg is not None:
        return '<{obj_name}({", ".join(formatted_args)}): {raw_text_arg}>'
    elif repr_arg is not None:
        return '<{obj_name}({", ".join(formatted_args)}): {repr_arg}>'
    else:
        return '<{obj_name}({", ".join(formatted_args)})>'
