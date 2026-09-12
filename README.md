# 🎓 CampusHub — College Event Management System

CampusHub is a web-based College Event Management System designed to simplify the process of discovering, managing, and registering for college events.

The platform provides separate interfaces for students and administrators, allowing students to explore upcoming events and manage their registrations while administrators can manage events and monitor registrations.

---

## 🌐 Live Demo

**Website:** https://collegeevent.infy.click

> The live application is hosted using PHP and MySQL.

---

## ✨ Features

### 👨‍🎓 Student Module

- Student registration
- Secure student login
- Password hashing
- Student dashboard
- Browse available college events
- Search and filter events
- Register for events
- View registered events
- Student logout
- Session-based authentication

### 🛠️ Admin Module

- Secure administrator login
- Admin dashboard
- View system statistics
- Add new events
- Edit existing events
- Delete events
- View event registrations
- Session-based admin authentication
- Automatic password hashing for supported admin accounts

### 🔐 Security & Database

- Prepared SQL statements
- Password hashing using PHP `password_hash()`
- Password verification using `password_verify()`
- Session-based authentication
- Protected student and admin pages
- Unique student email constraint
- Unique student-event registration constraint
- Foreign-key relationships
- Cascading event deletion
- Database credentials excluded from the public repository

---

## 💻 Technologies Used

| Technology | Purpose |
|---|---|
| PHP | Backend development |
| MySQL | Database management |
| HTML5 | Page structure |
| CSS3 | Styling and visual design |
| Bootstrap 5 | Responsive UI |
| JavaScript | Client-side interactions |
| XAMPP | Local development environment |
| InfinityFree | Live hosting |
| Git & GitHub | Version control |

---

## 📁 Project Structure

```text
CollegeEventManagement/
│
├── admin/
│   ├── add_event.php
│   ├── dashboard.php
│   ├── delete_event.php
│   ├── edit_event.php
│   ├── login.php
│   ├── logout.php
│   ├── view_events.php
│   └── view_registrations.php
│
├── students/
│   ├── dashboard.php
│   ├── events.php
│   ├── login.php
│   ├── logout.php
│   ├── my_registrations.php
│   ├── register.php
│   └── register_event.php
│
├── includes/
│   ├── db.php
│   └── db.example.php
│
├── images/
│   └── about-campus.png
│
├── js/
│   └── animations.js
│
├── index.php
├── about.php
├── contact.php
├── .gitignore
└── README.md
