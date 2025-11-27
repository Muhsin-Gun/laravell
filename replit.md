# NEXUS Car Rental Application

## Overview
NEXUS is a premium car rental web application built with Laravel 10. It features a modern, dark-themed UI with a complete car booking flow, M-Pesa payment integration, and role-based dashboards for admins, employees, and clients.

## Tech Stack
- **Backend**: Laravel 10 with PHP 8.2
- **Database**: PostgreSQL (Replit Neon-backed)
- **Frontend**: Blade templates with TailwindCSS
- **Payment**: M-Pesa STK Push integration (sandbox)

## Project Structure
```
app/
├── Http/Controllers/
│   ├── Admin/           # Admin controllers (Cars, Users, Blogs)
│   ├── BookingController.php
│   ├── CarController.php
│   ├── DashboardController.php
│   ├── HomeController.php
│   ├── PaymentController.php
│   ├── ProfileController.php
│   └── EmployeeController.php
├── Models/              # Eloquent models (User, Car, Booking, Review, Payment)
resources/
├── views/
│   ├── Admin/           # Admin dashboard views
│   ├── client/          # Client dashboard views
│   ├── employee/        # Employee dashboard views
│   ├── cars/            # Car listing and detail views
│   ├── bookings/        # Booking management views
│   ├── layouts/         # Layout templates
│   └── partials/        # Header, footer components
```

## Key Features
1. **Car Fleet Management**: 7 premium luxury vehicles (Audi RS7, Aston Martin, BMW M8, Porsche Panamera, Mercedes AMG GT 63, Porsche 911, Range Rover SVR)
2. **Booking System**: Date selection, price calculation, and checkout flow
3. **M-Pesa Integration**: STK Push payment with callback handling (server-side amount calculation for security)
4. **Role-Based Access**: Admin, Employee, and Client roles
5. **Admin Reports**: Revenue reports with CSV export, top rented cars, and transaction history
6. **Customer Reviews**: Review display on home page and car detail pages
7. **Modern UI**: Dark theme with cyan/blue gradients

## Database Setup
The app uses Replit's PostgreSQL database. Key tables:
- `users` - User accounts with role field (admin/employee/client)
- `cars` - Vehicle inventory with pricing and features
- `bookings` - Car rental bookings with dates and status
- `reviews` - Customer reviews linked to cars
- `payments` - M-Pesa payment records

## Test Accounts
- **Admin**: admin@nexus.com / password
- **Employee**: employee@nexus.com / password  
- **Client**: client@nexus.com / password

## Environment Variables Required
```
DB_CONNECTION=pgsql
DB_HOST=helium
DB_PORT=5432
DB_DATABASE=heliumdb
DB_USERNAME=postgres
DB_PASSWORD=password

# M-Pesa Configuration (sandbox)
MPESA_CONSUMER_KEY=your_consumer_key
MPESA_CONSUMER_SECRET=your_consumer_secret
MPESA_SHORTCODE=your_shortcode
MPESA_PASSKEY=your_passkey
MPESA_ENV=sandbox
```

## Routes Overview
- `/` - Home page with featured cars and reviews
- `/cars` - Fleet listing with filters
- `/cars/{id}` - Car detail with booking form
- `/dashboard` - Client dashboard
- `/admin/dashboard` - Admin dashboard
- `/employee/dashboard` - Employee dashboard
- `/checkout/{booking}` - Payment checkout page

## Recent Changes
- Nov 27, 2025: Added admin reports page with revenue analytics, top rented cars, and CSV export
- Nov 27, 2025: Fixed security issue - payment amount now calculated server-side to prevent manipulation
- Nov 27, 2025: Updated fleet to 7 featured luxury vehicles with high-quality images
- Nov 27, 2025: M-Pesa credentials stored as encrypted secrets (MPESA_CONSUMER_KEY, MPESA_CONSUMER_SECRET, MPESA_PASSKEY)
- Nov 27, 2025: Contact info updated to +254793027220 and muhsinabdi288@gmail.com
- Nov 27, 2025: Fixed admin dashboard route errors (cars.create -> admin.cars.create, users.edit -> admin.users.edit)
- Nov 27, 2025: Fixed view paths in controllers to use capital "Admin" matching directory structure
- Nov 27, 2025: Updated navbar - removed car icon, kept NEXUS branding only, centered menu with services dropdown
- Nov 27, 2025: Added comprehensive services section to homepage (Car Rentals, Airport Transfers, Corporate Fleet, Chauffeur Services)
- Nov 27, 2025: Added 6 customer reviews with gradient avatar circles to homepage
- Nov 27, 2025: Redesigned login and register pages with dark theme (cyan/blue gradients, modern styling)
- Nov 27, 2025: Improved footer with 5 columns, contact info, social links, and payment methods
- Nov 27, 2025: Fixed client dashboard layout by adding help/support section
- Nov 26, 2025: Fixed database configuration to use Replit PostgreSQL
- Nov 26, 2025: Updated car detail page with improved booking form
- Nov 26, 2025: Created checkout page with M-Pesa STK Push integration
- Nov 26, 2025: Added customer reviews section to home page

## Development Notes
- Server runs on port 5000
- Storage link created for car images: `php artisan storage:link`
- Run migrations: `php artisan migrate:fresh --seed`
- View paths use capital "A" (Admin) to match directory structure for case-sensitive systems
- SQLite has been removed, PostgreSQL is now the primary database
