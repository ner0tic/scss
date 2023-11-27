"""Create SQLAlchemy engine and session objects."""
from sqlalchemy import create_engine
from sqlalchemy.orm import sessionmaker
from flask import current_app as app

# Create database engine
engine = create_engine(app.config.get('SQLALCHEMY_DATABASE_URI'), echo=False)
# Create database session
Session = sessionmaker(bind=engine)
session = Session()
