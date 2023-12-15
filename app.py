"""Summer Camp Scheduling System"""
from .scss import create_app

print('creating app')
app = create_app()

if __name__ == "__main__":
    app.run(host="localhost", debug=True)
print('app created')