<!-- Copilot instructions for this Laravel app: concise, project-specific, actionable -->
# Project quick orientation

This repository is a Laravel 10 application with these important areas an AI coding agent should know immediately:

- Entry points and routing: `routes/web.php` defines the main pages. The app expects some named routes (e.g. `home`, `marketplace`, `checkout`) used directly from Blade partials such as `resources/views/partials/header.blade.php`.
- Controllers live in `app/Http/Controllers/`. Example: `HomeController` uses `App\\Models\\Car` to fetch cars and return `resources/views/home.blade.php`.
- Views: `resources/views/layouts/app.blade.php` is the main layout; `partials/header.blade.php` is included by it and must not call `route('...')` without verifying the route exists (use `Route::has('name')`).
- Models and DB: Eloquent models are under `app/Models/`. Migrations live in `database/migrations/`.
- Configuration: `.env` drives DB choice. By default this repo uses MySQL (`DB_CONNECTION=mysql`), but parts of the project also support SQLite (errors occur when `database/database.sqlite` is missing).

# Common developer commands (explicit)

- Install & prepare (Windows / project root):
```
composer install
copy .env.example .env   # or edit .env directly (Windows `copy`)
php artisan key:generate
```
- Database (MySQL/XAMPP): start MySQL in XAMPP, then create DB and migrate:
```
"C:\\xampp\\mysql\\bin\\mysql" -u root -e "CREATE DATABASE IF NOT EXISTS laravel CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
php artisan config:clear
php artisan migrate
php artisan serve
```
- Database (SQLite alternative): create file if you prefer file DB:
```
# PowerShell
New-Item -Path .\\database -ItemType Directory -Force
New-Item -Path .\\database\\database.sqlite -ItemType File -Force
php artisan config:clear
php artisan migrate
```
- Useful inspection commands:
```
php artisan route:list            # check named routes
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan migrate:status
php artisan tinker
php artisan test                  # runs phpunit
```

# Patterns and repo-specific conventions (do not assume defaults)

- Blade route usage: header partial calls `route('marketplace')` and `route('checkout')`. If these routes are absent the app will throw RouteNotFoundException. Preferred safe pattern used elsewhere is `@if(Route::has('marketplace')) ... @endif`.
- Tailwind/THEME: The UI uses Tailwind classes heavily in layout and partials. Keep class-based markup intact when editing views.
- Session/cart: header displays session cart contents with `session('cart')`. Treat session as possibly missing or empty; check existence before counting.
- DB connection switch: project `.env` currently uses MySQL. Agents should not unilaterally switch DB drivers — ask the user if they want to use SQLite instead, or create DB files when adding SQLite support.

# Integration points and external dependencies

- XAMPP MySQL (developer environment): many users run DB via XAMPP. The repo has commands that assume the MySQL socket at 127.0.0.1:3306.
- Mail testing uses Mailpit in `.env` (`MAIL_HOST=mailpit`). Keep this when adding mail changes unless user requests change.
- Vendor tools: standard Laravel packages in `vendor/` — use `composer` for dependency changes.

# Typical fault patterns we've seen (helpful to auto-detect & fix)

- "Route [marketplace] not defined": fix by adding a named route in `routes/web.php` or guard calls in `resources/views/partials/header.blade.php` with `Route::has()`.
- "Database file at path [database/database.sqlite] does not exist": either create `database/database.sqlite` or set `.env` to MySQL and ensure XAMPP MySQL is running.
- Duplicate controller methods (Cannot redeclare HomeController::index()): ensure only one `index()` exists or rename additional action and update routes.

# When editing files, prefer minimal, targeted changes

- Modify Blade templates to use guards for optional routes; do not remove whole partials. Example safe replacement pattern for header links:
```
@if(Route::has('marketplace'))
  <a href="{{ route('marketplace') }}">Fleet</a>
@else
  <span>Fleet</span>
@endif
```
- When adding controllers or routes, place new controllers under `app/Http/Controllers/` and register named routes in `routes/web.php` near other page routes.

# Where to look for examples

- Home flow: `app/Http/Controllers/HomeController.php`, `app/Models/Car.php`, `resources/views/home.blade.php`.
- Header and layout: `resources/views/partials/header.blade.php`, `resources/views/layouts/app.blade.php`.
- Routes: `routes/web.php`, `routes/web_car_rental.php` (project contains multiple route files — check which are included).

# If you need to make automated fixes, follow this checklist

1. Run `php artisan route:list` — if named route missing, either add route or guard Blade.
2. Check `.env` DB settings — if `sqlite` is used, ensure `database/database.sqlite` exists; if `mysql`, ensure MySQL is running and DB exists.
3. Clear caches: `php artisan config:clear && php artisan route:clear && php artisan view:clear`
4. Run migrations: `php artisan migrate`

---
If anything here is unclear or you want the agent to prefer SQLite vs MySQL, tell me which preference to bake in and I will update this file accordingly.
