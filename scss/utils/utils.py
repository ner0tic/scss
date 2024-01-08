""" Utility functions for the application. """
from flask import request, url_for

INTERNAL_SERVER_ERROR = 500
NOT_FOUND = 404
UNAUTHORIZED = 401

def url_for_other_page(**kwargs):
    """Returns a URL aimed at the current request endpoint and query args."""
    url_for_args = request.args.copy()
    if 'pjax' in url_for_args:
        url_for_args.pop('_pjax')
    for key, value in kwargs.items():
        url_for_args[key] = value
    return url_for(request.endpoint, **url_for_args)


def gettext(string):
    """Returns a translated string."""
    return string
