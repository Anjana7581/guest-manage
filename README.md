
# Guest Management System (Laravel + Sanctum)

A simple **Laravel application** for managing guests with authentication, CRUD operations, and a clean dashboard UI.  
This project uses **Laravel Sanctum** for authentication and **Bootstrap** for styling.

---

## 🚀 Features
- 🔐 User authentication (login/logout)
- 📊 Dashboard overview
- 👥 Manage Guests (CRUD)
  - Add, Edit, View, Delete Guests
- 📱 Responsive & modern UI
- 📑 Pagination with Bootstrap
- ✅ Validation with custom error messages

---

## 🛠️ Tech Stack
- **Backend:** Laravel 12, PHP 8+
- **Frontend:** Blade, Bootstrap 5, FontAwesome
- **Auth:** Laravel Sanctum
- **Database:** MySQL

---

## 📂 Installation

1. Clone the repository:  
   ```bash
   git clone https://github.com/your-username/guest-management.git
   cd guest-management
````

2. Install dependencies:

   ```bash
   composer install
   npm install && npm run dev
   ```
3. Copy `.env` file and configure database:

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. Run migrations & seeders:

   ```bash
   php artisan migrate --seed
   ```
5. Start the development server:

   ```bash
   php artisan serve
   ```

🔑 **Default Admin Login:**

```
Email: admin@example.com
Password: password
```

---

## 📜 License

This project is licensed under the MIT License.

```
