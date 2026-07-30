# Installation & Deployment Guide
**COMP3340 Civic Parts Depot**

This document provides complete instructions for deploying the Civic Parts Depot application to a new web server. These steps are optimized for a cPanel-based or standard LAMP (Linux, Apache, MySQL, PHP) stack, such as the `myweb.cs.uwindsor.ca` student hosting environment.

---

## 1. Prerequisites
Before beginning the installation, ensure your target server meets the following requirements:
*   **Web Server:** Apache or Nginx
*   **PHP:** Version 7.4 or newer (must have the PDO and JSON extensions enabled)
*   **Database:** MySQL 5.7+ or MariaDB

## 2. File Deployment
To get the application files onto your server:
1. Connect to your web server using an FTP client (like FileZilla) or via SSH.
2. Upload the entire contents of this project directory into your server's public web root (typically named `public_html`, `www`, or `htdocs`).
3. **Directory Permissions:** Ensure that the web server has read access to all files. Specifically, check that the `assets/images/` and `assets/media/` directories have standard `755` permissions so multimedia files render correctly for end users.

## 3. Database Initialization
The application requires a MySQL database to function. You will need to build the tables and insert the initial catalog records.
1. Log in to your database administration tool (e.g., phpMyAdmin or the MySQL command line).
2. Create a new, empty database. For robust text support, set the collation to `utf8mb4_unicode_ci`. (Example name: `comp3340_civic_depot`).
3. Select this newly created database.
4. **Import the Schema:** Locate `schema.sql` in the project root. Import and execute this file first. It will generate the necessary tables: `users`, `products`, `product_options`, `orders`, and `service_requests`.
5. **Import the Data:** Locate `seed.sql` in the project root. Import and execute this file second. It will populate the database with the required 20+ catalog items, pricing tiers, and default user accounts.

## 4. Application Configuration
You must link the PHP application to your newly created database.
1. Locate the `config.php` (or `includes/db.php`) file in the root of your uploaded project.
2. Open the file in a text editor and update the database credential constants to match your server environment:

```php
// Replace these values with your live server credentials
define('DB_HOST', 'localhost'); // Usually 'localhost' on myweb.cs.uwindsor.ca
define('DB_NAME', 'your_database_name');
define('DB_USER', 'your_database_user');
define('DB_PASS', 'your_database_password');
```
3. Save the file and ensure the updated version is uploaded to the server.