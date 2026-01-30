# 💈 Barberos

A **simple web booking service for a barbershop**, built using **PHP, HTML, CSS, and JavaScript**. Barberos allows customers to register, log in, view services, and book appointments online, while administrators can manage bookings and uploaded images.

---

## 📌 Table of Contents

1. Project Overview
2. Features
3. Technologies Used
4. Project Structure
5. Installation & Setup
6. Database Setup
7. Core Functionalities
8. Application Flow
9. Future Improvements
10. License

---

## 📖 Project Overview

Barberos is designed to digitalize the traditional barbershop booking process. Instead of walk‑ins or manual scheduling, customers can conveniently book appointments online, reducing conflicts and improving customer experience.

---

## ✨ Features

### 👤 User Features

* User registration and login
* Password reset via email
* View barbershop information and services
* Book appointments online
* View booked appointments

### 🛠 Admin / Staff Features

* View all bookings
* Edit existing bookings
* Delete bookings
* Upload and manage images

### 🌐 Public Pages

* Home
* About
* Pricing
* Blog
* Contact

---

## 🧠 Technologies Used

| Layer    | Technology            |
| -------- | --------------------- |
| Frontend | HTML, CSS, JavaScript |
| Backend  | PHP                   |
| Database | MySQL                 |
| Styling  | Custom CSS            |

---

## 📂 Project Structure

```
Barberos/
├── css/                    # Stylesheets
├── fonts/                  # Font assets
├── images/                 # Image assets
├── js/                     # JavaScript files
├── index.php               # Home page
├── login.php               # Login page
├── register.php            # User registration
├── logout.php              # Logout handler
├── booking.php             # Booking form
├── confirm.php             # Booking confirmation
├── view.php                # View bookings
├── edit.php                # Edit booking
├── delete.php              # Delete booking
├── fetch_booked_dates.php  # Fetch unavailable dates
├── upload.php              # Image upload
├── image.php               # Image display
├── reset-password.php      # Password reset
├── sendemail.php           # Email handler
├── config.php              # Database configuration
├── hrdnwghm_barberos.sql   # Database SQL dump
├── README.md               # Project documentation
└── *.html                  # Static pages
```

---

## 🚀 Installation & Setup

### 1️⃣ Clone the Repository

```
git clone https://github.com/nyeeeerk/Barberos.git
cd Barberos
```

### 2️⃣ Start a Local PHP Server

```
php -S localhost:8000
```

Then open your browser and go to:

```
http://localhost:8000/index.php
```

---

## 🗄 Database Setup

1. Create a database in MySQL
2. Import the SQL file:

```
hrdnwghm_barberos.sql
```

3. Configure database credentials in **config.php**:

```php
<?php
$host = "localhost";
$user = "your_username";
$password = "your_password";
$database = "your_database_name";
?>
```

---

## 🔄 Core Functionalities

### 🔐 Authentication

* Handles secure login and registration
* Session‑based authentication
* Password recovery via email

### 📅 Booking System

* Prevents double‑booking using fetched booked dates
* Allows users to view and manage their appointments

### 🖼 Image Management

* Upload barber or service images
* Display uploaded images dynamically

---

## 🧭 Application Flow

1. User registers or logs in
2. User browses services
3. User selects an available date and time
4. Booking is confirmed and saved
5. Admin can manage bookings and images

---

## 🔮 Future Improvements

* Email booking confirmations
* Mobile‑responsive UI improvements
* Migration to a PHP framework (e.g., Laravel)
* REST API integration

---

## 📄 License

This project is for **educational purposes**. You are free to modify and improve it.

---

### 👨‍💻 Author

**Charles Ryan D. Robianes**
GitHub: [https://github.com/nyeeeerk](https://github.com/nyeeeerk)

### Presentation Link
Canva: (https://www.canva.com/design/DAFx1GfqNE4/DEyf70Gk6P_nc9Ctw5lhOA/edit?utm_content=DAFx1GfqNE4&utm_campaign=designshare&utm_medium=link2&utm_source=sharebutton)
