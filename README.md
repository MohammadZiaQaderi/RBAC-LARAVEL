Setup Instructions

Prerequisites:
PHP (>=8.0)
Composer
MySQL or any compatible database
Node.js and npm (for frontend assets)
Laravel (latest version)
Installation Steps:
Clone the repository:
git clone https://github.com/MohammadZiaQaderi/RBAC-LARAVEL.git
cd RBAC-LARAVEL
Install dependencies:
composer install
npm install && npm run build
Set up environment variables:
cp .env.example .env
Update .env file with database credentials, gmail credentials.
Generate application key:
php artisan key:generate
Run database migrations and seed:
php artisan migrate --seed
Start the development server:
php artisan serve
Access the application:
Open http://127.0.0.1:8000 in your browser.

Features Implemented

User Authentication
Register/Login using email verification.
Role-based authentication (Admin & User).
Employee Management
CRUD (Create, Read, Update, Delete) operations for employees.
Employees are assigned to the user who created them.
Users can only manage their own employees.
Admin can manage all employees.
Search & Filtering
Search employees by name and email.
Categorization of employees by department.
Profile Management
Update user profile, including profile picture upload.
Display profile picture in user dropdown.
Bulk Import via CSV
Import employees from a CSV file with validation.
Error handling for invalid or duplicate entries.
Notifications
Email verification for new users.
Notification on successful employee addition.

Role-Based Access Control

Admin:
Manage all employees and users.
Access admin dashboard.
Approve or deactivate users.
User:
Can only manage their own employees.
Cannot access other users' data.
