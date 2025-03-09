# Laravel 10 Full-Stack Application

## 📌 Prerequisites

Ensure you have the following installed on your system:

- **Laravel 10**
- **PHP 8.1**
- **MySQL Server**

## 🚀 Project Setup

### 1️⃣ Clone the Repository

Run the following command to clone the repository:

```sh
git clone https://github.com/thusy12/laravel-fullstack-application.git
```

### 2️⃣ Navigate to Project Directory

```sh
cd web-app
```

### 3️⃣ Configure Environment Variables

Copy the `.env.example` file to `.env` and update the following details:

#### Database Configuration

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

#### Mail Configuration (For Email Notifications)

Create an account on [Mailtrap](https://mailtrap.io/) and update your `.env` file:

```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=any_mail_address_as_your_wish
MAIL_FROM_NAME="${APP_NAME}"
```

### 4️⃣ Install Dependencies

Run the following command to install PHP dependencies:

```sh
composer install
```

### 5️⃣ Generate Application Key

```sh
php artisan key:generate
```

### 6️⃣ Install Frontend Dependencies

```sh
npm install
npm run dev
```

### 7️⃣ Optimize Application

```sh
php artisan optimize
```

### 8️⃣ Start Development Server

```sh
php artisan serve
```

### 9️⃣ Run Database Migrations

```sh
php artisan migrate
```

### 🔟 Seed Database with Default Roles

```sh
php artisan db:seed --class=RolesSeeder
```

---

✅ Your Laravel application is now set up and ready to use! 🎉

## 🔐 User Roles

- **Admin**: Registration must be manually added to the database. But Admins can log in with their registered credentials.
- **Contributor**: Can register and log in via the provided forms.

## 📂 Database Tables

- **Users**: Stores user details.
- **Roles**: Stores role details (Admin, Contributor).
- **Images**: Stores uploaded images and their approval status.

## 🔑 Authentication & Authorization

The application uses Laravel’s built-in authentication (Breeze) with role-based authorization:

- **Admin**: Can view, approve, and deny uploaded images.
- **Contributor**: Can upload images.

## 🎯 Features

### Contributor Functionalities

- Register/Login as a Contributor.
- Account activation after verifying email.
- Upload images.
- Image resizing before storing.
- SoftDeletes to images.
- View uploaded images with their approval status.

### Admin Functionalities

- Login as Admin.
- View all submitted images from Contributors.
- Approve or deny an image submission.
- Send email notifications to the contributor when an image is approved or denied.

## 🛠️ Technologies Used

- **PHP**
- **Laravel**
- **MySQL**
- **JavaScript**
- **HTML & CSS**
- **Bootstrap**