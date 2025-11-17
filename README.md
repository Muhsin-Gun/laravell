# 🚗 FutureCar Rental Platform

A modern, full-stack Laravel car rental platform with M-PESA integration, employee management, analytics, and loyalty programs. Dark-themed UI with neon accents.

## Features

- 👥 **Multi-Role System**: Client, Employee, Admin roles
- 🚗 **Car Management**: Browse, search, filter vehicles
- 📅 **Booking System**: Date range selection with automatic pricing
- 💳 **M-PESA Integration**: Secure payment processing
- 📊 **Admin Dashboard**: Analytics and management tools
- ⭐ **Loyalty Program**: Points system for customers
- 🎨 **Modern UI**: Dark theme with neon accents

## Installation

### 1. Install Dependencies

```bash
composer install
npm install
```

### 2. Environment Setup

```bash
cp .env.example .env
php artisan key:generate
```

### 3. Configure Database

Update your `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=car_rental
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Configure M-PESA (Optional)

Add to `.env`:

```env
MPESA_CONSUMER_KEY=your_key
MPESA_CONSUMER_SECRET=your_secret
MPESA_SHORTCODE=174379
MPESA_PASSKEY=your_passkey
MPESA_ENV=sandbox
```

### 5. Run Migrations & Seed Data

```bash
php artisan migrate
php artisan db:seed --class=InitialDataSeeder
```

### 6. Create Storage Link

```bash
php artisan storage:link
```

### 7. Compile Assets

```bash
npm run dev
```

### 8. Start Server

```bash
php artisan serve
```

Visit: `http://localhost:8000`

## Default Users

After seeding, you can login with:

**Admin:**
- Email: admin@carrental.test
- Password: password

**Employee:**
- Email: employee@carrental.test
- Password: password

**Client:**
- Email: client@carrental.test
- Password: password

## Project Structure

```
├── app/
│   ├── Http/Controllers/     # Controllers
│   ├── Models/                # Eloquent models
│   ├── Services/              # Business logic
│   └── Http/Middleware/       # Custom middleware
├── database/
│   ├── migrations/            # Database migrations
│   └── seeders/               # Database seeders
├── resources/
│   ├── views/                 # Blade templates
│   ├── css/                   # Stylesheets
│   └── js/                    # JavaScript
└── routes/
    └── web.php                # Web routes
```

## Usage

### For Clients
1. Register/Login
2. Browse available cars
3. Select dates and book
4. Complete payment via M-PESA
5. View bookings in dashboard

### For Admins
1. Login with admin credentials
2. Access admin dashboard
3. Manage cars (CRUD operations)
4. Manage users and roles
5. View analytics

## Technologies

- **Backend**: Laravel 10
- **Frontend**: Blade Templates, Tailwind CSS
- **Database**: MySQL
- **Payment**: M-PESA Daraja API
- **Authentication**: Laravel Auth

## License

This project is open-sourced software licensed under the MIT license.

## Support

For support, email support@carrental.com or call +1234567890 (24/7)

---

Made with ❤️ for Kenya's transportation revolution 🇰🇪
