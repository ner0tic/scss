"""Summer Camp Scheduling System"""
from .scss import create_app

app = create_app()

if __name__ == "__main__":
    app.run(host="localhost", debug=True)