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

- Custom middleware system using `$_SESSION`
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
docker-compose build
docker-compose up
docker-compose exec -it php bash
```

Inside the container:

```bash
composer install
composer migrate
composer seed
```


---

## 📂 Project Structure (Simplified)

```
app/
  controllers/
  models/
  views/
routes/
storage/
public/
```

---

## 📌 Notes

This project is intended as a learning and portfolio project, showcasing backend development skills and architectural understanding.
Controllers are instantiated per route using factories for simplicity. This project intentionally 
avoids a DI container to keep the architecture transparent and framework-independent.
