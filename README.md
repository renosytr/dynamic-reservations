# Dynamic Reservations

Dynamic Reservations is a Laravel 12 application built with **FrankenPHP**, **Laravel Octane**, **Inertia.js**, **Vite**, and **PostgreSQL**. This README will help developers run it locally and provide guidance for deployment.

---

## Table of Contents

1. [Features](#features)  
2. [Requirements](#requirements)  
3. [Local Setup](#local-setup)  
4. [Docker Setup](#docker-setup)  
5. [Running the App](#running-the-app)  
6. [Database](#database)  
7. [Deployment Guide](#deployment-guide)  
8. [Troubleshooting](#troubleshooting)  

---

## Features

- High-performance backend using **Laravel Octane + FrankenPHP**
- Frontend built with **Vue 3 + Inertia.js + Vite**
- Queue workers and scheduled tasks via **Supervisor**
- PostgreSQL database integration
- Scalable Dockerized architecture  

---

## Requirements

- Docker >= 24  
- Docker Compose >= 2.20  
- Node.js >= 20 (optional if using Docker Node service)  
- PHP >= 8.2 (Docker handles this)

---

## Local Setup

1. **Clone the repository**
```bash
git clone <REPOSITORY_URL>
cd dynamic-reservations
```

2. **Copy environment file**
```bash
cp .env.example .env
```

3. **Update environment variables**  
Set `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD`.  
For Docker, use:
```env
DB_HOST=db
DB_PORT=5432
DB_DATABASE=dynamic_reservations
DB_USERNAME=postgres
DB_PASSWORD=secret
```

---

## Docker Setup

The project uses **multi-stage Docker builds**:

1. **Build and start containers**
```bash
docker compose up -d --build
```

2. **Check running containers**
```bash
docker ps
```
You should see: `app`, `node`, and `db` containers.

3. **Install frontend dependencies (if needed)**
```bash
docker compose exec node npm install
docker compose exec node npm run build
```

4. **Install backend dependencies (if needed)**
```bash
docker compose exec app composer install
```

---

## Running the App

1. **Run migrations and seed the database**
```bash
docker compose exec app php artisan migrate
docker compose exec app php artisan db:seed
```

2. **Access the application**
- App: [http://localhost:8000](http://localhost:8000)  
- Vite dev server: [http://localhost:5173](http://localhost:5173)

3. **Supervisor manages the following services**:
- Laravel Octane server
- Queue workers
- Scheduler  

---

## Database

- Default database: **PostgreSQL**
- Docker volume: `dynamic-reservations_postgres_data`
- Migration & seeding:
```bash
docker compose exec app php artisan migrate
docker compose exec app php artisan db:seed
```

---

## Deployment Guide

1. **Build Docker images for production**
```bash
docker compose -f docker-compose.prod.yml up -d --build
```

2. **Environment variables**
- Make sure `.env` contains production settings (DB credentials, APP_URL, CACHE_DRIVER, SESSION_DRIVER, etc.).

3. **Database migrations**
```bash
docker compose exec app php artisan migrate --force
```

4. **Serving app**
- The `app` container runs **FrankenPHP + Octane**.
- Supervisor manages queue workers and scheduler.
- Expose port 80 or configure a reverse proxy (Nginx/Caddy) for production.

5. **Cache & optimize**
```bash
docker compose exec app php artisan config:cache
docker compose exec app php artisan route:cache
docker compose exec app php artisan view:cache
```

---

## Troubleshooting

- **500 Internal Server Error**  
  - Check `.env` database credentials.  
  - Ensure migrations and seeding are run.  
  - Check Octane logs via:
```bash
docker compose logs -f app
```

- **Vite not found**  
  - Run npm install in the Node container:
```bash
docker compose exec node npm install
```

- **Supervisor issues**  
  - Ensure `.docker/supervisord.conf` is correctly configured and rebuild the `app` container if you made changes.

