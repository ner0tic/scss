"""Initialize Flask app."""
from flask import Flask
from flask_sqlalchemy import SQLAlchemy
import config

def create_app():
    """Construct the core application."""
    # Initialize Flask App
    app = Flask(__name__, instance_relative_config=False)
    # Load Config data from env file
    app.config.from_object("config.Config")
    # Initialize Database
    db = SQLAlchemy(app)

    with app.app_context():
        return _create_tables(db, app)

def _create_tables(db, app):
    # Import routes & models
    from . import routes
    import models
    from database import engine, session
    
    # Create database tables for our data models
    db.create_all()
    models.Base.metadata.create_all(engine)

    return app