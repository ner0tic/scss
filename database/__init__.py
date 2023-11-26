"""Create SQLAlchemy engine and session objects."""
from sqlalchemy import create_engine
from sqlalchemy.orm import sessionmaker
from flask import current_app as app

# from config.Config import SQLALCHEMY_DATABASE_URI

# Create database engine
engine = create_engine(app.config.get('SQLALCHEMY_DATABASE_URI'), echo=False)
#engine = create_engine("sqlite+pysqlite:///:memory:", echo=True)
# Create database session
Session = sessionmaker(bind=engine)
session = Session()