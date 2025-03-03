To set up the project execute this commands:

- composer install
- make copy of the .env.example as .env
- populate fields for your database name, username and password
- php artisan serve (to start the project)
- npm run dev
- php artisan migrate:fresh --seed (run all migrations and populate database with data)

Project has web routes accessible within the browser and api routes for connecting with other projects (secured by sanctum).
For accessing the api routes you need to store the token recived within login as bearer token.
Available api routes:

GET /api/projects - retriving all projects for authenticated user
GET /api/project/{projectId} - retriving specific project
POST /api/project - creating project
PUT /api/project/{projectId} - updating specififc project
DELETE /api/project/{projectId} - removing project

GET /tasks/{projectId} - retriving all tasks that belongs to specific project for authenticated user
GET /task/{taskId}/{projectId} - retriving specific 1 task that belongs in given project
POST /task/{projectId} - creating task in project
PUT /task/{taskId} - updating task in project
DELETE /task/{taskId} - removing task from project