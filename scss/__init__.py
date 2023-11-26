"""Initialize Flask app."""
from flask import Flask
from flask_sqlalchemy import SQLAlchemy
import config

# Initialize Database
db = SQLAlchemy()

def create_app():
    """Construct the core application."""
    
    # Initialize Flask App
    app = Flask(__name__, instance_relative_config=False)
    # Load Config data from env file
    app.config.from_object("config.Config")
    # Initialize Database Plugin
    db.init_app(app)

    with app.app_context():
        # Import routes
        from . import routes  
        # Create database tables for our data models
        db.create_all()  

        return app