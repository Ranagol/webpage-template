# 💼 PHP MVC Web App (Vanilla PHP, No Framework)

## 🚀 Overview

This project is a fully custom-built MVC web application developed using **vanilla PHP**, without relying on frameworks like Laravel or Symfony.

The goal was to deeply understand how modern PHP frameworks work internally by recreating core features such as routing, middleware, templating, and ORM integration from scratch.

---

## 🧠 What This Project Demonstrates

- Building an MVC architecture from scratch
- Designing authentication and middleware systems
- Creating RESTful APIs
- Working with databases using an ORM (Eloquent)
- Handling file uploads and processing (CSV parsing)
- Integrating third-party APIs (Guzzle)
- Using Docker for a complete development environment
- Debugging with Xdebug
- Writing maintainable, structured backend code

---

## ✨ Key Features

- 🔐 User authentication (login & registration with validation)
- 🧩 Middleware-based route protection
- 🗂️ Full CRUD operations (web + API)
- 📊 CSV upload, processing, and report generation
- 🖼️ User-specific image uploads
- 🌐 External API integration
- 📝 Centralized error logging with custom exceptions
- ⚙️ Environment-based configuration (`.env`)
- 🐳 Fully Dockerized setup

---

## 🧩 Interesting Implementation Details

- Custom middleware system using `$_SESSION`
- Blade templating engine integrated without Laravel
- CSV processing engine that aggregates cost data by category
- Centralized exception handling with logging via a base exception class
- Separation of concerns using MVC principles

---

## 🛠️ Tech Stack

- PHP (Vanilla)
- MySQL
- Bootstrap
- Composer
- Docker
- Xdebug
- Guzzle
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
docker-compose exec -it php-container bash
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

## 🎯 Why I Built This

I built this project to gain a deeper understanding of how PHP frameworks like Laravel function internally.  
By implementing core features manually, I strengthened my knowledge of backend architecture, request handling, and application design patterns.

---

## 🧪 Additional Features

- Train scheduling algorithm challenge (CLI command)
- PHP DebugBar integration
- Static analysis using PHPStan

---

## 📌 Notes

This project is intended as a learning and portfolio project, showcasing backend development skills and architectural understanding.

---

## 📬 Contact

Feel free to reach out or connect with me if you have feedback or opportunities!
