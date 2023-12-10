import time

from flask import Flask, g, render_template, request
from flask_login import login_required
import arrow
import requests

from scss import config
from scss.assets import assets
from scss.auth import auth
from scss.commands import create_db, drop_db, populate_db, recreate_db
from scss.database import db
from scss.extensions import lm, travis, mail, migrate, bcrypt, babel, rq, limiter, cache
from scss.user import user
from scss.utils import utils, url_for_other_page
from scss.organization import organization
from scss.enrollment import enrollment


def create_app(config=config.base_config):
    """Returns an initialized Flask application."""
    app = Flask(__name__)
    app.config.from_object(config)

    register_extensions(app)
    register_blueprints(app)
    register_errorhandlers(app)
    register_jinja_env(app)
    register_commands(app)
    
    with app.app_context():
        db.create_all()

    @app.before_request
    def before_request():
        """Prepare some things before the application handles a request."""
        g.request_start_time = time.time()
        g.request_time = lambda: '%.5fs' % (time.time() - g.request_start_time)
        g.pjax = 'X-PJAX' in request.headers

    @app.route('/', methods=['GET'])
    def index():
        """Returns the applications index page."""
        return render_template('layout.jinja2', title='Summer Camp Scheduling System')
    
    @app.route('/home', methods=['GET'])
    @login_required
    def home():
        """Returns the applications home page."""
        return render_template('home.jinja2', title='Summer Camp Scheduling System')

    return app


def register_commands(app):
    """Register custom commands for the Flask CLI."""
    for command in [create_db, drop_db, populate_db, recreate_db]:
        app.cli.command()(command)


def register_extensions(app):
    """Register extensions with the Flask application."""
    def get_locale():
        """Returns the locale to be used for the incoming request."""
        return request.accept_languages.best_match(config.base_config.SUPPORTED_LOCALES)

    travis.init_app(app)
    db.init_app(app)
    lm.init_app(app)
    mail.init_app(app)
    bcrypt.init_app(app)
    assets.init_app(app)
    babel.init_app(app, locale_selector=get_locale)
    rq.init_app(app)
    migrate.init_app(app, db)
    limiter.init_app(app)
    cache.init_app(app, config={'CACHE_TYPE': 'SimpleCache'})


def register_blueprints(app):
    """Register blueprints with the Flask application."""
    app.register_blueprint(utils)
    app.register_blueprint(user, url_prefix='/user')
    app.register_blueprint(auth)
    app.register_blueprint(organization)
    app.register_blueprint(enrollment)



def register_errorhandlers(app):
    """Register error handlers with the Flask application."""

    def render_error(e):
        return render_template(f'errors/{e.code}.html'), e.code

    for e in [
        requests.codes.INTERNAL_SERVER_ERROR,
        requests.codes.NOT_FOUND,
        requests.codes.UNAUTHORIZED,
    ]:
        app.errorhandler(e)(render_error)


def register_jinja_env(app):
    """Configure the Jinja env to enable some functions in templates."""
    app.jinja_env.globals.update({
        'timeago': lambda x: arrow.get(x).humanize(),
        'url_for_other_page': url_for_other_page,
    })