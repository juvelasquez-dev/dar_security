# 🌾 E-Agraryo Merkado  
### Role-Based Agricultural Marketplace & Management System  

---

🚀 A full-stack Laravel web application designed to digitize and streamline agricultural operations for DAR Region V, including user management, ARBO monitoring, and a scalable marketplace platform.

---

## 🔥 Highlights
- 🧠 Role-Based System Architecture (Super Admin, PBD/Admin, Finance, ARBO)  
- 🔐 Authentication System (Email/Password + Google OAuth)  
- 🗂️ User Lifecycle Management (Registration → Approval → Activation)  
- ⚙️ Modular MVC Structure using Laravel  
- 📊 Dashboard-Based Workflows per Role  
- 🛒 Marketplace System (In Progress)  

---

## 🧩 Problem It Solves

Traditional processes in agricultural organizations are often:
- manual (paper-based or chat-based)  
- inefficient (slow coordination and reporting)  
- hard to track (no centralized system)  

👉 This project transforms those into a **centralized digital platform** where:
- users are managed systematically  
- ARBO operations are monitored  
- marketplace transactions can be scaled digitally  

---

## 🏗️ System Architecture

**Frontend**
- Blade Templates (Laravel)  
- HTML, CSS, JavaScript  

**Backend**
- Laravel (PHP)  
- MVC Architecture  
- RESTful Routing  

**Database**
- MySQL  
- Relational schema (Users, Roles, Provinces, etc.)  

**Authentication**
- Laravel Auth  
- Google OAuth via Socialite  

---

## 👥 User Roles & Responsibilities

| Role | Capabilities |
|------|-------------|
| **Super Admin** | Full system control, user management, approvals |
| **PBD/Admin (CARPOS)** | ARBO supervision, regional monitoring |
| **Finance** | Financial reporting and transaction monitoring |
| **ARBO** | Marketplace access, product/order management |

---

## ⚙️ Core Features

### 🔐 Authentication & Access Control
- Login / Registration system  
- Google login integration  
- Role-based redirection  
- Pending user approval system  

### 👤 User Management
- Add, edit, and manage users  
- Assign roles and provinces  
- Filter and search users  
- Approval workflow for new accounts  

### 📊 Dashboards
- Dedicated dashboards per role  
- Structured navigation for each module  

### 🧾 Admin Modules (Ongoing)
- ARBO Management  
- Marketplace Monitoring  
- Sales Reporting  
- Activity Logs  

### 🛒 Marketplace (Planned)
- Product listing  
- Order management  
- Buyer-seller interaction  
- Inventory tracking  

---

## 🧠 Technical Skills Demonstrated

- Laravel MVC Architecture  
- RESTful routing and controllers  
- Eloquent ORM relationships  
- Role-based access control (RBAC)  
- Authentication (including OAuth integration)  
- Database design and migrations  
- Blade templating and UI structuring  
- Debugging and system refactoring  

---

## 🚀 Getting Started

### 1. Clone the repository
```bash
git clone https://github.com/your-repo/e-agraryo.git
cd e-agraryo
```

### 2. Install dependencies
```bash
composer install
npm install
```

### 3. Configure environment
```bash
cp .env.example .env
php artisan key:generate
```

Update your database credentials in `.env`.

### 4. Run migrations
```bash
php artisan migrate
```

### 5. Start the server
```bash
php artisan serve
```

---

## 📂 Project Structure
```bash
app/
 ├── Http/Controllers/
 ├── Models/
resources/
 ├── views/
routes/
 ├── web.php
database/
 ├── migrations/
```

---

## 🚧 Current Status

🟡 Actively in Development  

✔️ Authentication & User Management  
✔️ Role-based dashboards  
⚙️ Marketplace system (in progress)  
⚙️ Reports & analytics (in progress)  

---

## 📈 Future Enhancements
- Full marketplace implementation (products, orders, payments)  
- Advanced analytics dashboard  
- Activity logging system  
- API integration  
- Mobile-responsive UI  

---

## 👨‍💻 Developer

**Rudy Boringot Jr.**
**Justine Velasquez**

- BS Information Technology  
- Full-stack web development (Laravel, MySQL, JavaScript)  
- Passionate about building systems that solve real-world problems  

---

## 💡 Key Takeaway

This project demonstrates my ability to:
- design and build a multi-role system from scratch  
- structure a scalable Laravel application  
- integrate authentication and real-world workflows  
- transition from UI prototype to functional system  

---

## 📜 License

This project is for academic and portfolio purposes.  
Laravel is licensed under the MIT License.