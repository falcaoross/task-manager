
````markdown
# Task Manager

A **full-stack task management web application** built with **Laravel, PHP, MySQL, Blade, and Tailwind CSS**.  
This project demonstrates **authentication, authorization, CRUD operations**, and **clean Laravel architecture**.

---

## 🌟 Features

- User authentication (**Register / Login / Logout**)  
- Profile management using **Laravel Breeze**  
- Create, edit, and delete tasks  
- Mark tasks as **completed** or **incomplete**  
- Task **due dates**  
- **User-specific task visibility**  
- Pagination  
- **Tailwind CSS** UI  
- Flash messages

---

## 🛠 Tech Stack

- **Backend:** PHP, Laravel  
- **Frontend:** Blade Templates, Tailwind CSS  
- **Database:** MySQL  
- **Authentication:** Laravel Breeze  
- **Version Control:** Git & GitHub  
- **Build Tool:** Vite

---

## 🚀 Running Locally

Follow these steps to get the project up and running locally:

### 1. Clone the repository
```bash
git clone https://github.com/falcaoross/laravel-task-manager.git
cd laravel-task-manager
````

### 2. Install backend dependencies

```bash
composer install
```

### 3. Install frontend dependencies

```bash
npm install
```

### 4. Environment setup

```bash
cp .env.example .env
php artisan key:generate
```

### 5. Configure the database in `.env`

**Option A (SQLite – quickest)**

```env
DB_CONNECTION=sqlite
```

Create the database file:

```bash
touch database/database.sqlite
```

**Option B (MySQL)**

```env
DB_CONNECTION=mysql
DB_DATABASE=task_manager
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Run migrations

```bash
php artisan migrate
```

### 7. Build assets

```bash
npm run dev        # for development
# or
npm run build      # for production
```

### 8. Start the server

```bash
php artisan serve
```

Your app will be available at: `http://127.0.0.1:8000`

---

## 🔗 Resources

* [Laravel Documentation](https://laravel.com/docs)
* [Tailwind CSS Documentation](https://tailwindcss.com/docs)
* [Laravel Breeze](https://laravel.com/docs/10.x/starter-kits#laravel-breeze)

```
