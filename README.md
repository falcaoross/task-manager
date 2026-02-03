Task Manager

A full-stack task management web application built using Laravel, PHP, MySQL, Blade, and Tailwind CSS.
This project demonstrates authentication, authorization, CRUD operations, and clean Laravel architecture.

FEATURES
- User authentication (Register / Login / Logout)
- Profile management using Laravel Breeze
- Create, edit, delete tasks
- Mark tasks as completed or incomplete
- Due date support
- User-specific task visibility
- Pagination
- Tailwind CSS UI
- Flash messages

TECH STACK
Backend: PHP, Laravel
Frontend: Blade Templates, Tailwind CSS
Database: MySQL
Auth: Laravel Breeze
Version Control: Git & GitHub
Build Tool: Vite

RUNNING LOCALLY
1. Clone repository
   git clone https://github.com/falcaoross/laravel-task-manager.git
   cd laravel-task-manager

2. Install backend dependencies
   composer install

3. Install frontend dependencies
   npm install

4. Environment setup
   cp .env.example .env
   php artisan key:generate

5. Configure database in .env
   Option A (SQLite, quickest):
   DB_CONNECTION=sqlite
   # Create the database file
   touch database/database.sqlite

   Option B (MySQL):
   DB_CONNECTION=mysql
   DB_DATABASE=task_manager
   DB_USERNAME=root
   DB_PASSWORD=

6. Run migrations
   php artisan migrate

7. Build assets (choose one)
   npm run dev
   # or for production build
   npm run build

8. Start server
   php artisan serve
