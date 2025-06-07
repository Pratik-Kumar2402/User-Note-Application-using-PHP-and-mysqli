# User Note Application using PHP and MySQLi

A simple web application for user registration, login, and personal note management.

## Features

- User registration and login
- Add, edit, and delete personal notes
- Responsive UI with Bootstrap and custom CSS
- Contact form to send messages to the author

## Project Structure

```
config.php
contact.php
footer.php
header.php
login_form.php
logout.php
register_form.php
user_page.php
css/
    contact.css
    header_footer.css
    style.css
    user.css
```

## Setup Instructions

### 1. Prerequisites

- PHP (7.x or above)
- MySQL
- Web server (e.g., Apache via [XAMPP](https://www.apachefriends.org/index.html) or [WAMP](https://www.wampserver.com/))

### 2. Installation

1. **Clone or copy the project files**  
   Place all files in your web server's root directory:
   - For XAMPP: `C:\xampp\htdocs\User-Note-Application-using-PHP-and-mysqli\`
   - For WAMP: `C:\wamp\www\User-Note-Application-using-PHP-and-mysqli\`

2. **Create the Database**

   - Open [phpMyAdmin](http://localhost/phpmyadmin/)
   - Create a database named `user_db`
   - Run the following SQL to create the required tables:

     ```sql
     CREATE TABLE `user_form` (
       `id` INT AUTO_INCREMENT PRIMARY KEY,
       `name` VARCHAR(255),
       `email` VARCHAR(255),
       `password` VARCHAR(255)
     );

     CREATE TABLE `notes` (
       `sr_no` INT AUTO_INCREMENT PRIMARY KEY,
       `name` VARCHAR(255),
       `title` VARCHAR(255),
       `description` TEXT,
       `time` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
     );
     ```

3. **Configure Database Connection**

   - The connection is set in [`config.php`](config.php):

     ```php
     $conn = mysqli_connect('localhost','root','','user_db');
     ```

   - If your MySQL password is not empty, update the connection accordingly.

### 3. Running the Application

- Start Apache and MySQL from your XAMPP/WAMP control panel.
- Open your browser and go to:  
  ```
  http://localhost/User-Note-Application-using-PHP-and-mysqli/register_form.php
  ```
- Register a new user, then log in to manage your notes.

### 4. Main Files

- Registration: [`register_form.php`](register_form.php)
- Login: [`login_form.php`](login_form.php)
- User Dashboard: [`user_page.php`](user_page.php)
- Contact: [`contact.php`](contact.php)

### 5. Customization

- Update email in [`contact.php`](contact.php) for contact form delivery.
- Modify CSS in the [`css/`](css/) directory for styling.

---

**Note:**  
This project is for learning/demo purposes. Passwords are stored using MD5 (not recommended for production). For real applications, use password hashing functions like `password_hash()` and `password_verify()`.
