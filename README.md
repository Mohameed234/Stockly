# Stockly – Inventory Management System

Stockly is a simple and scalable **Inventory Management System** built using **Laravel MVC**.  
The system helps businesses manage items, stock movements, warehouses, and alerts through a clean and organized interface.

---

## ✨ Features

### Items Management
- Add, edit, delete items
- Categorize items

### Inventory Transactions
- Stock-in / Stock-out operations
- Transfers between locations
- Track quantity before/after movement
- Full transaction history

### Locations Management
- Create and manage warehouses/branches
- Assign stock to specific locations

### Smart Alerts
- Low stock alerts
- Expiry alerts (if applicable)

### User Roles & Permissions
- Admin
- Storekeeper
- Auditor
- Custom user roles

### Security
- Authentication & authorization
- Role-based access control
- CSRF protection

### Reports
- Stock report
- Transactions report
- Transfers report

---

## 🛠️ Tech Stack

- Laravel 10+
- PHP 8.1+
- MySQL
- Blade (MVC)
- Bootstrap or TailwindCSS
- JavaScript / Axios

---

## 📦 Installation

### 1. Clone the repository
```bash
git clone https://github.com/Mohameed234E/stockly.git
cd stockly
```

### 2. Install dependencies
```bash
composer install
npm install
npm run build
```

### 3. Environment setup
```bash
cp .env.example .env
php artisan key:generate
```
Update .env with your database configuration.

### 4. Run migrations and seeders
```bash
php artisan migrate --seed
```

### 5. Start the development server
```bash
php artisan serve
```


### Default Credentials
Email: test@example.com
Password: password123


ذذذ
ذذ
