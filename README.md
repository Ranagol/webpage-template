# 💼 PHP MVC Web App (Vanilla PHP, No Framework)

## 🚀 Overview

This project is a fully custom-built MVC web application developed using **vanilla PHP**, without relying on frameworks like Laravel or Symfony.

The goal was to deeply understand how modern PHP frameworks work internally by recreating core features such as routing, middleware, templating, and ORM integration from scratch.

---

## 🧠 What This Project Demonstrates

- Building an MVC architecture from scratch
- Designing authentication and middleware systems
- Working with databases using an ORM (Eloquent)
- Handling file uploads and processing (CSV parsing)
- Using Docker for a complete development environment
- OOP 


---

## ✨ Key Features

- 🔐 User authentication (login & registration with validation)
- 🧩 Middleware-based route protection
- 📊 CSV upload, processing, and report generation
- 🖼️ User-specific uploads
- 📝 Centralized error logging with custom exceptions
- ⚙️ Environment-based configuration (`.env`)
- 🐳 Fully Dockerized setup

---

## 🧩 Interesting Implementation Details

- Blade templating engine integrated, it can be uses similarly as in Laravel
- CSV processing engine that aggregates cost data by category
- Centralized exception handling with logging via a base exception class
- Separation of concerns using MVC principles
- Train scheduling algorithm challenge (CLI command)
- Heroes and Monsters challenge

---

## 🛠️ Tech Stack

- PHP (Vanilla)
- MySQL
- Bootstrap
- Composer
- Docker
- Xdebug
- Eloquent ORM (`illuminate/database`)
- bramus/router

---

## ⚙️ Getting Started

### Prerequisites
- Docker installed

### Setup
```bash
gh repo clone Ranagol/webpage-template
cd webpage-template && cp .env.example .env
```

### Create/run/enter Docker container

```bash
docker-compose up -d --build
docker-compose exec -it php bash
```

## Then, inside the Docker container:

```bash
git config --global --add safe.directory /srv/www
composer install
composer migrate
composer seed
chmod -R 755 cache
mkdir -p storage/logs && chmod -R 755 storage/logs
mkdir -p storage/upload && chmod -R 755 storage/upload
chown -R www-data:www-data cache storage/logs storage/upload
```
- Now the app is running, and it can be accesed here: http://127.0.0.1:8001/
- Visit this link. In order to acces the app, you must register yourself. After registration you will have access to the app's functions.


---

## 📌 Notes

- This project is intended as a learning and portfolio project, showcasing backend development skills and architectural understanding.
- Controllers are instantiated per route using factories for simplicity. This project intentionally 
avoids a DI container to keep the architecture transparent and framework-independent.
