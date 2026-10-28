# Sport Club Management System – Task 6

## Overview

This project is a Sport Club Management System developed using **Laravel 13, PHP 8.4, MySQL, and Docker**.

Task 6 extends the existing web application by implementing RESTful APIs for authentication, player management, match management, and player assignment.

The API uses **Laravel Sanctum** for token-based authentication, Laravel API Resources for consistent JSON responses, and Form Requests for input validation.

## Technologies Used

- PHP 8.4
- Laravel 13
- MySQL 8.4
- Docker
- Laravel Sanctum
- RESTful APIs
- Postman
- Git and GitHub

## Features

### API Authentication

- Login using email and password
- Generate an API Bearer Token
- Access protected endpoints
- Logout and revoke the current token

### Player Management

- List all players
- View player details
- Create new players
- Update player information
- Delete players
- Restrict create, update, and delete operations to trainers

### Match Management

- List all matches
- View match details
- Create matches
- Update match information
- Delete matches
- Assign players to matches

## API Endpoints

### Authentication

| Method | Endpoint      | Description                          |
| ------ | ------------- | ------------------------------------ |
| POST   | `/api/login`  | Authenticate user and generate token |
| GET    | `/api/user`   | Get authenticated user               |
| POST   | `/api/logout` | Revoke current token                 |

### Players

| Method    | Endpoint            | Description             |
| --------- | ------------------- | ----------------------- |
| GET       | `/api/players`      | List players            |
| GET       | `/api/players/{id}` | Get player details      |
| POST      | `/api/players`      | Create player (Trainer) |
| PUT/PATCH | `/api/players/{id}` | Update player (Trainer) |
| DELETE    | `/api/players/{id}` | Delete player (Trainer) |

### Matches

| Method    | Endpoint                    | Description              |
| --------- | --------------------------- | ------------------------ |
| GET       | `/api/matches`              | List matches             |
| GET       | `/api/matches/{id}`         | Get match details        |
| POST      | `/api/matches`              | Create match (Trainer)   |
| PUT/PATCH | `/api/matches/{id}`         | Update match (Trainer)   |
| DELETE    | `/api/matches/{id}`         | Delete match (Trainer)   |
| POST      | `/api/matches/{id}/players` | Assign players (Trainer) |

All endpoints except login require authentication.

## Authentication Example

**POST** `/api/login`

Request:

```json
{
    "email": "trainer@example.com",
    "password": "YOUR_PASSWORD"
}
```

Example successful response (200 OK):

```json
{
    "message": "Login successful.",
    "user": {
        "id": 1,
        "first_name": "Example",
        "last_name": "Trainer",
        "email": "trainer@example.com",
        "role": "trainer",
        "registration_date": "2026-10-07"
    },
    "token": "EXAMPLE_BEARER_TOKEN",
    "token_type": "Bearer"
}
```

For protected requests, include:

```text
Authorization: Bearer YOUR_TOKEN
Accept: application/json
```

## Create Player Example

**POST** `/api/players`

```json
{
    "first_name": "Test",
    "last_name": "Player",
    "email": "test.player@example.com",
    "password": "TestPass123!"
}
```

Expected status: **201 Created**.

## Create Match Example

**POST** `/api/matches`

```json
{
    "name": "Friendly Match",
    "match_date": "2026-11-15",
    "match_time": "16:30",
    "location": "Sport Club Stadium",
    "description": "Friendly match for registered players"
}
```

Expected status: **201 Created**.

## Assign Players Example

**POST** `/api/matches/3/players`

```json
{
    "players": [2, 5]
}
```

The player IDs must exist and belong to users with the `player` role.

Expected status: **200 OK** when valid players are assigned.

## Authorization and Validation

- Laravel Sanctum protects authenticated API routes.
- Only trainers can create, update, or delete players and matches.
- Only trainers can assign players to matches.
- Form Requests validate submitted data.
- Passwords are stored using Laravel's hashing mechanism.
- API Resources control the fields returned in JSON responses.

### HTTP Status Codes

| Code | Meaning            |
| ---- | ------------------ |
| 200  | Successful request |
| 201  | Resource created   |
| 401  | Unauthenticated    |
| 403  | Forbidden          |
| 404  | Resource not found |
| 422  | Validation failed  |

## Installation and Setup

1. Clone the repository:

```bash
git clone --branch Task6 https://github.com/khlaif/Training_ITG.git
cd Training_ITG
```

2. Install PHP dependencies:

```bash
composer install
```

3. Configure the environment:

```bash
cp .env.example .env
php artisan key:generate
```

4. Configure MySQL connection details in `.env` according to the local Docker setup.

5. Start the database container:

```bash
docker compose up -d
```

6. Run database migrations:

```bash
php artisan migrate
```

7. Start Laravel:

```bash
php artisan serve
```

The API base URL is:

```text
http://127.0.0.1:8000/api
```

## API Testing

Postman is used to test API endpoints, JSON request bodies, Bearer Token authentication, validation, and HTTP status codes.

Tests include successful authentication, CRUD operations, player assignment, and invalid input handling.

## Project Structure

```text
app/
  Http/
    Controllers/
      Api/
    Requests/
      Api/
    Resources/
  Models/

routes/
  api.php
  web.php

database/
  migrations/

ScreenShot/
  Task6/
```

## Previous Tasks

- Task 2: Authentication and Role-Based Dashboards
- Task 3: Player Management CRUD
- Task 4: Match Management and Player Assignment
- Task 5: Player Dashboard, Profile, and Assigned Matches
- Task 6: REST API Development with Laravel Sanctum

## Security Notes

API tokens must be kept private. Passwords, real Bearer Tokens, and `.env` credentials must not be committed to GitHub or included in screenshots.

## Repository
