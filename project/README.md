# 🔐 PHP Authentication System (OTP Based)

This is a simple and secure user authentication system built using PHP and MySQL/PostgreSQL. It includes OTP-based email/phone verification during registration and password reset. It supports login, session management, and user dashboard access.

---

## 📁 Project Structure
```
auth_project/
│
├── config/
│ └── db.php ← Database connection file
│
├── helpers/
│ └── functions.php ← Functions for sending OTP, utilities
│
├── register.php ← User registration form + OTP sending
├── verify_otp.php ← OTP verification and account creation
├── login.php ← Login with email/phone + password
├── forgot_password.php ← Request OTP for password reset
├── reset_password.php ← Enter OTP + set new password
├── dashboard.php ← Protected user dashboard (after login)
└── init.sql ← SQL script to create the users table

```
---
## ⚙️ Features

- ✅ User registration with OTP verification
- ✅ Unique username, email, and phone number checks
- ✅ Password hashing with `password_hash()`
- ✅ Login using email or phone number
- ✅ Forgot password with OTP verification
- ✅ Session-based login and logout
- ✅ User dashboard after login

---

## 📧 Email Sending Configuration

### 🔧 Set your email in `helpers/functions.php`

To enable OTP delivery, you must set your **email credentials** in the file:
```

helpers/functions.php

Example setup (if using Gmail SMTP):

```php
$mail->Host = 'smtp.gmail.com';
$mail->Username = 'your_email@gmail.com';      // Your email address
$mail->Password = 'your_app_password';         // Gmail App Password
$mail->Port = 587;
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->SMTPAuth = true;
```
⚠️ Note: Gmail requires 2-Step Verification to use App Passwords.
Go to Google App Passwords to generate one.

💾 Database Schema
Run this SQL from init.sql:
```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone VARCHAR(20) UNIQUE NOT NULL,
    password TEXT NOT NULL,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    address TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```
🚀 How to Use
1. Clone/download the project folder

2. Import init.sql into your MySQL/PostgreSQL database

3. Update database settings in config/db.php

4. Go to helpers/functions.php and set your email credentials

5. Start a local PHP server (e.g., XAMPP)

6. Open register.php in your browser and test the full flow


---


🧑‍💻 Author
Developed by [Moloy Das]

✅ Notes
Sanitize user input to avoid SQL Injection (if not using prepared statements)

Use HTTPS in production

Protect forms with CSRF tokens in a live environment








