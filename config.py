"""Database config."""
from os import getenv, path
from dotenv import load_dotenv

# Load variables from .env
basedir = path.abspath(path.dirname(__file__))
load_dotenv(path.join(basedir, ".env"))

class Config:
    # Environment variables
    SECRET_KEY = getenv("SECRET_KEY")
    FLASK_APP = getenv("FLASK_APP")
    FLASK_ENV = getenv("FLASK_ENV")

    # Session variables
    SECRET_KEY = getenv("SECRET_KEY")
    
    # Database connection variables
    DATABASE_USERNAME = getenv("DATABASE_USERNAME")
    DATABASE_PASSWORD = getenv("DATABASE_PASSWORD")
    DATABASE_HOST = getenv("DATABASE_HOST")
    DATABASE_PORT = getenv("DATABASE_PORT")
    DATABASE_NAME = getenv("DATABASE_NAME")
    DATABASE_CERT_FILE = getenv("DATABASE_CERT_FILE")
    # 
    attach_ca_file = f"?ssl_ca={DATABASE_CERT_FILE}" if DATABASE_CERT_FILE is not None else ""   
    SQLALCHEMY_DATABASE_URI = f"mysql+pymysql://{DATABASE_USERNAME}:{DATABASE_PASSWORD}@{DATABASE_HOST}:{DATABASE_PORT}/{DATABASE_NAME}{attach_ca_file}"
    

    # Reset data after each run
    CLEANUP_DATA = False
    
    # Static Assets
    STATIC_FOLDER = "static"
    TEMPLATES_FOLDER = "templates"