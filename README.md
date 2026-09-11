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

Run the database migrations:

```bash
docker compose exec app php artisan migrate
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
# koda-task-management
