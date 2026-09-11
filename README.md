# Task Management API

A simple Laravel task management API built as part of a coding challenge.

## Requirements

* Docker
* Docker Compose

## Running the Project

Clone the repository and start the containers:

```bash
docker compose up -d --build
```

The application will be available at:

```text
http://localhost:8000
```

### Environment Setup

Copy the example environment file:

```bash
cp .env.example .env
```

Update the database settings in `.env` to match `docker-compose.yml`:

```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=todo
DB_USERNAME=koda
DB_PASSWORD=secret
```

Generate the Laravel application key:

```bash
docker compose exec app php artisan key:generate
```

Run the database migrations and seed the database:

```bash
docker compose exec app php artisan migrate --seed
```

## Authentication

Authentication is handled through the login endpoint:

```text
POST /api/v1/login
```

Use the seeded user credentials to log in and obtain an authentication token.

For authenticated requests, include the token:

```text
Authorization: Bearer <token>
```

## Running Tests

The tests are PHPUnit Feature tests.

Run all tests:

```bash
docker compose exec app php artisan test
```

Run a specific test:

```bash
docker compose exec app php artisan test tests/Feature/Projects/DeleteProjectTest.php
```

## Stopping the Project

```bash
docker compose down
```
