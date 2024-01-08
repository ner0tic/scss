""" Extensions module. Each extension is initialized in the app factory located in app.py. """
from flask_admin import Admin
from flask_assets import Environment
from flask_babel import Babel
from flask_bcrypt import Bcrypt
from flask_limiter import Limiter
from flask_limiter.util import get_remote_address
from flask_login import LoginManager
from flask_mail import Mail
from flask_migrate import Migrate
from flask_rq2 import RQ
from flask_travis import Travis
from flask_caching import Cache
from flask_principal import Principal

admin = Admin(name='scss', template_mode='bootstrap3')
assets = Environment()
babel = Babel()
bcrypt = Bcrypt()
cache = Cache()
limiter = Limiter(key_func=get_remote_address)
lm = LoginManager()
mail = Mail()
migrate = Migrate()
rq = RQ()
travis = Travis()
principals = Principal()
