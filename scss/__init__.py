"""Initialize Flask app."""
from flask import Flask
from flask_sqlalchemy import SQLAlchemy
# from flask_login import LoginManager
# from sqlalchemy import create_engine
# from sqlalchemy.orm import sessionmaker
# from sqlalchemy import create_engine
# from sqlalchemy.orm import sessionmaker
# from scss.models import Base
import config
# from . import routes

def create_app():
    """Construct the core application."""
    # Initialize Flask App
    app = Flask(__name__, instance_relative_config=False)
    # Load Config data from env file
    app.config.from_object("config.Config")
    # Initialize Database
    db = SQLAlchemy(app)
    # Create database engine
    
    
    # Initialize LoginManager
    #login_manager = LoginManager()
    


    with app.app_context():
        return _create_tables(db, app)

def _create_tables(db, app):
    # Import routes & models
    from . import routes
    import scss.models
   
    from database import engine, session
    
    # Create database tables for our data models
    db.create_all()
    models.Base.metadata.create_all(engine)

    return app