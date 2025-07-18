# 🗓️ Event Management System

A full-featured Event Management System built with **Laravel 12**, **Inertia.js**, **Vue 3**, and **MySQL**.  
Includes admin panel, API endpoints, authentication, authorization (roles), and database seeders.

---

## 🚀 Features

- Laravel 12 + Inertia.js + Vue 3
- Admin panel for Events, Users, Registrations
- API endpoints for event browsing and registration
- Form validation (web & API)
- Authorization via policies and middleware
- Database seeders with sample data
- Queue job for registration confirmation (stub)
- Role-based access control (`admin` / `user`)
- Laravel Sanctum for API authentication
- Shared Inertia data and flash messages

---

## ⚙️ Installation Instructions

> 💡 Prerequisites:
> - PHP 8.2+
> - MySQL
> - Composer
> - Node.js + NPM
> - Git

---

### 🛠️ Step-by-Step Setup

```bash
# 1. Clone the project
git clone https://github.com/YOUR_USERNAME/YOUR_REPO_NAME.git
cd YOUR_REPO_NAME

# 2. Install PHP dependencies
composer install

# 3. Install JavaScript dependencies
npm install

# 4. Copy .env file
cp .env.example .env

# 5. Set your DB credentials in .env
# Make sure database exists (event_manager)

# 6. Generate app key
php artisan key:generate

# 7. Migrate and seed database
php artisan migrate --seed

# 8. Start Laravel dev server
php artisan serve

# 9. In another terminal, run Vite
npm run dev
