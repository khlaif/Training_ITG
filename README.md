# Sport Club Management System

## Task 2 – Laravel Phase 1

A web-based Sport Club Management System developed using the Laravel PHP framework. This project rebuilds the previous PHP application using Laravel and implements the basic authentication and role-based dashboard functionality.

## 1. Project Features

- Homepage with club information and navigation links.
- User registration with Trainer and Player roles.
- User login and logout.
- Form validation using Laravel.
- Secure password hashing.
- Role-based redirection after login.
- Separate Trainer and Player dashboards.
- Display of logged-in user information.
- Database management using Laravel migrations.
- MySQL database running with Docker.

## 2. Technologies Used

- PHP
- Laravel
- MySQL
- Docker
- HTML and CSS
- Blade Templates
- Git and GitHub

## 3. Project Structure

The application follows Laravel's MVC structure.

- `app/Http/Controllers/` – Registration and authentication controllers.
- `app/Models/User.php` – User model.
- `database/migrations/` – Database migrations.
- `resources/views/home.blade.php` – Homepage.
- `resources/views/auth/` – Registration and login pages.
- `resources/views/dashboards/` – Trainer and Player dashboards.
- `resources/views/layouts/app.blade.php` – Shared application layout.
- `routes/web.php` – Application routes.
- `docker-compose.yml` – Docker database configuration.

## 4. Project Setup

### Step 1: Clone the Repository

```bash
git clone -b "Task2(Laravel_Phase1)" https://github.com/khlaif/Training_ITG.git
cd Training_ITG
```

### Step 2: Install Dependencies

Make sure PHP, Composer, and Docker Desktop are installed.

```bash
composer install
```

### Step 3: Configure the Environment

Create the `.env` file from `.env.example`.

On Windows PowerShell:

```powershell
Copy-Item .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

### Step 4: Configure the Database

Update the database settings in `.env` to match the MySQL service configured in `docker-compose.yml`.

For example, when MySQL is exposed locally on port 3306:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sport_club
DB_USERNAME=root
DB_PASSWORD=your_database_password
```

The database name, username, password, and port must match the Docker configuration.

### Step 5: Start Docker

Start the MySQL database container:

```bash
docker compose up -d
```

Check that the container is running:

```bash
docker compose ps
```

### Step 6: Run Database Migrations

```bash
php artisan migrate
```

The users table includes:

- First Name
- Last Name
- Email
- Password
- Role
- Timestamps

### Step 7: Run the Application

```bash
php artisan serve
```

Open the application in your browser:

http://127.0.0.1:8000

## 5. Authentication and User Roles

The application supports two user roles: Trainer and Player.

During registration, users enter their first name, last name, email, password, password confirmation, and selected role.

Laravel validates the registration information and securely hashes passwords before storing them in the database.

After successful login, users are redirected according to their roles.

| Role | Dashboard URL |
|---|---|
| Trainer | `/trainer/dashboard` |
| Player | `/player/dashboard` |

Both dashboards display a welcome message, first name, last name, email address, user role, and logout button.

## 6. Application Routes

| Method | URL | Description |
|---|---|---|
| GET | `/` | Homepage |
| GET | `/register` | Registration page |
| POST | `/register` | Process registration |
| GET | `/login` | Login page |
| POST | `/login` | Authenticate user |
| POST | `/logout` | Logout user |
| GET | `/trainer/dashboard` | Trainer dashboard |
| GET | `/player/dashboard` | Player dashboard |


## 7. Project Scope

This project implements Phase 1 of the Sport Club Management System.

The current phase focuses on Laravel project setup, authentication, database migrations, user roles, and basic dashboards.

Player management, match management, and additional role-based management functionality are outside the scope of this phase and will be implemented in future tasks.
