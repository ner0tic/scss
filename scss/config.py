"""Database config."""
from os import getenv, path, environ
from dotenv import load_dotenv

# Load variables from .env
basedir = path.abspath(path.dirname(__file__))
load_dotenv(path.join(basedir, ".env"))

class base_config(object):
    """Default configuration options."""
    SITE_NAME = environ.get('APP_NAME', 'Summer Camp Scheduling System5')
    SECRET_KEY = getenv("SECRET_KEY")
    FLASK_APP = getenv("FLASK_APP")
    FLASK_ENV = getenv("FLASK_ENV")

    SECRET_KEY = getenv("SECRET_KEY")
    CSRF_SECRET_KEY = getenv("CSRF_SECRET_KEY")
    SERVER_NAME = environ.get('SERVER_NAME', '127.0.0.1:5000')

    MAIL_SERVER = environ.get('MAIL_SERVER', 'mail')
    MAIL_PORT = environ.get('MAIL_PORT', 1025)

    REDIS_HOST = environ.get('REDIS_HOST', 'redis')
    REDIS_PORT = environ.get('REDIS_PORT', 6379)
    RQ_REDIS_URL = f'redis://{REDIS_HOST}:{REDIS_PORT}'

    CACHE_HOST = environ.get('MEMCACHED_HOST', 'memcached')
    CACHE_PORT = environ.get('MEMCACHED_PORT', 11211)

    DATABASE_USERNAME = getenv("DATABASE_USERNAME")
    DATABASE_PASSWORD = getenv("DATABASE_PASSWORD")
    DATABASE_HOST = getenv("DATABASE_HOST")
    DATABASE_PORT = getenv("DATABASE_PORT")
    DATABASE_NAME = getenv("DATABASE_NAME")
    DATABASE_CERT_FILE = getenv("DATABASE_CERT_FILE")
    
    POSTGRES_HOST = environ.get('POSTGRES_HOST', 'postgres')
    POSTGRES_PORT = environ.get('POSTGRES_PORT', 5432)
    POSTGRES_USER = environ.get('POSTGRES_USER', 'postgres')
    POSTGRES_PASS = environ.get('POSTGRES_PASS', 'postgres')
    POSTGRES_DB = environ.get('POSTGRES_DB', 'postgres')
    
    attach_ca_file = f"?ssl_ca={DATABASE_CERT_FILE}" if DATABASE_CERT_FILE is not None else ""
    SQLALCHEMY_DATABASE_URI = f"mysql+pymysql://{DATABASE_USERNAME}:{DATABASE_PASSWORD}@{DATABASE_HOST}:{DATABASE_PORT}/{DATABASE_NAME}{attach_ca_file}"
    SQLALCHEMY_TRACK_MODIFICATIONS = False
    
    # Reset data after each run
    CLEANUP_DATA = False
    
    # Static Assets
    STATIC_FOLDER = "static"
    TEMPLATES_FOLDER = "templates"

    SUPPORTED_LOCALES = ['en']


class dev_config(base_config):
    """Development configuration options."""
    ASSETS_DEBUG = True
    WTF_CSRF_ENABLED = False


class test_config(base_config):
    """Testing configuration options."""
    TESTING = True
    WTF_CSRF_ENABLED = False