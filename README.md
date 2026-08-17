# 🍽️ FoodQueue

**FoodQueue** is a web-based Restaurant Management System built with Laravel.

The application helps restaurant staff manage menus, customer orders, kitchen queues, receipts, and sales information in one centralized system.

## ✨ Features

- 📊 **Dashboard** — Monitor orders, revenue, menus, categories, and latest transactions.
- 🗂️ **Category Management** — Create, edit, and manage menu categories.
- 🍔 **Menu Management** — Manage menus, prices, categories, and availability.
- 🧾 **Order Management** — Create orders, automatic queue numbers, item calculation, search, and status management.
- 👨‍🍳 **Kitchen Display** — Monitor orders from Waiting → Processing → Ready → Completed.
- 🖨️ **Receipt Printing** — Receipt preview and 80mm thermal receipt printing.
- 📈 **Sales Report** — Monitor restaurant transactions and sales performance.

## 🛠️ Tech Stack

- **Backend:** PHP, Laravel, Eloquent ORM
- **Frontend:** Blade, Tailwind CSS, JavaScript
- **Database:** MySQL
- **Authentication:** Laravel Breeze
- **Tools:** Vite, Laragon, Git, GitHub

## 🔄 Order Workflow

```text
Waiting → Processing → Ready → Completed
```

## 🚀 Installation

```bash
git clone <repository-url>
cd foodqueue

composer install
npm install

php artisan key:generate
php artisan migrate

php artisan serve
npm run dev
```

Open:

```text
http://127.0.0.1:8000
```

## 📋 Project Status

| Module | Status |
|---|---|
| Authentication | ✅ Completed |
| Category Management | ✅ Completed |
| Menu Management | ✅ Completed |
| Order Management | ✅ Completed |
| Kitchen Display | ✅ Completed |
| Dashboard | ✅ Completed |
| Receipt Printing | ✅ Completed |
| Sales Report | 🚧 In Development |

## 🗺️ Roadmap

- [x] Dashboard
- [x] Category Management
- [x] Menu Management
- [x] Order Management
- [x] Kitchen Display
- [x] Receipt Printing
- [ ] Sales Report
- [ ] Sales Analytics
- [ ] Export Report
- [ ] Production Deployment

## 👨‍💻 Author

**M. Hasbianur**

Full Stack Developer

Built with **Laravel · PHP · Blade · Tailwind CSS · JavaScript · MySQL**