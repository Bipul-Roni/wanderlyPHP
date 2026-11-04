# Wanderly Travel Booking — PHP Starter

A responsive travel discovery / booking-inquiry website built with **PHP, MySQL, HTML, CSS and vanilla JavaScript**. It includes community trip submissions and a WordPress-inspired admin dashboard.

## Features
- Responsive travel landing page and trip cards
- Search published trips by title or destination
- Public trip submission form (new submissions are **pending**)
- Trip detail page and inquiry form
- Admin login with password hashing
- Admin dashboard: publish, reject, reset to pending, delete trips
- Admin inquiry overview
- PDO prepared statements, output escaping, CSRF tokens

## Requirements
- PHP 8.0+ (8.1+ recommended)
- MySQL / MariaDB
- XAMPP, WAMP, MAMP, or similar local stack

## Run locally (XAMPP)
1. Start **Apache** and **MySQL** from XAMPP.
2. Copy this project folder into `C:\\xampp\\htdocs\\travel_booking_php`.
3. Open phpMyAdmin at `http://localhost/phpmyadmin`.
4. Import `database.sql` (creates the `travel_booking` database and tables).
5. Check `config.php` and update database host/name/user/password if needed. Default XAMPP credentials are `root` with an empty password.
6. Visit `http://localhost/travel_booking_php/install-admin.php` and create your admin login.
7. **Delete `install-admin.php` after creating the admin.**
8. Website: `http://localhost/travel_booking_php/`
9. Admin: `http://localhost/travel_booking_php/admin-login.php`

## GitHub
Do not commit real passwords, production database credentials, or private user data. For a real deployment, move DB credentials into environment variables and configure HTTPS.

## Important scope
This is a **starter project**, not a production-ready travel agency booking/payment platform. It currently supports listing trips and sending inquiries; it does not include online payment, inventory/availability, booking confirmation, email notifications, user accounts, or image upload. Image cover is currently a URL field. Add those features before accepting real payments or sensitive traveler data.
"# wanderlyPHP" 
