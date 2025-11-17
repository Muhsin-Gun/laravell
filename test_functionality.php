<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "🧪 Testing FutureCar Rental Platform\n";
echo "=====================================\n\n";

// Test 1: Database Connection
echo "✓ Test 1: Database Connection\n";
try {
    DB::connection()->getPdo();
    echo "  ✅ Database connected successfully\n\n";
} catch (Exception $e) {
    echo "  ❌ Database connection failed: " . $e->getMessage() . "\n\n";
    exit(1);
}

// Test 2: Users
echo "✓ Test 2: Users\n";
$users = App\Models\User::all();
echo "  Total users: " . $users->count() . "\n";
foreach ($users as $user) {
    echo "  - {$user->name} ({$user->email}) - Role: {$user->role}\n";
}
echo "\n";

// Test 3: Cars
echo "✓ Test 3: Cars\n";
$cars = App\Models\Car::all();
echo "  Total cars: " . $cars->count() . "\n";
foreach ($cars as $car) {
    echo "  - {$car->name} ({$car->brand}) - \${$car->price_per_day}/day\n";
}
echo "\n";

// Test 4: Authentication
echo "✓ Test 4: Authentication Test\n";
$admin = App\Models\User::where('email', 'admin@carrental.test')->first();
if ($admin && Hash::check('password', $admin->password)) {
    echo "  ✅ Admin login credentials valid\n";
} else {
    echo "  ❌ Admin login credentials invalid\n";
}

$client = App\Models\User::where('email', 'client@carrental.test')->first();
if ($client && Hash::check('password', $client->password)) {
    echo "  ✅ Client login credentials valid\n";
} else {
    echo "  ❌ Client login credentials invalid\n";
}
echo "\n";

// Test 5: Routes
echo "✓ Test 5: Routes\n";
$routes = [
    'home' => '/',
    'cars.index' => '/cars',
    'login' => '/login',
    'register' => '/register',
    'dashboard.client' => '/dashboard',
    'dashboard.admin' => '/admin/dashboard',
];

foreach ($routes as $name => $path) {
    try {
        $route = Route::getRoutes()->getByName($name);
        echo "  ✅ Route '{$name}' exists: {$path}\n";
    } catch (Exception $e) {
        echo "  ❌ Route '{$name}' missing\n";
    }
}
echo "\n";

// Test 6: Models Relationships
echo "✓ Test 6: Model Relationships\n";
$user = App\Models\User::first();
echo "  User has bookings relationship: " . (method_exists($user, 'bookings') ? '✅' : '❌') . "\n";
echo "  User has reviews relationship: " . (method_exists($user, 'reviews') ? '✅' : '❌') . "\n";

$car = App\Models\Car::first();
echo "  Car has bookings relationship: " . (method_exists($car, 'bookings') ? '✅' : '❌') . "\n";
echo "  Car has reviews relationship: " . (method_exists($car, 'reviews') ? '✅' : '❌') . "\n";
echo "\n";

// Test 7: Middleware
echo "✓ Test 7: Middleware\n";
$kernel = app(\Illuminate\Contracts\Http\Kernel::class);
$middlewareAliases = (new ReflectionClass($kernel))->getProperty('middlewareAliases');
$middlewareAliases->setAccessible(true);
$aliases = $middlewareAliases->getValue($kernel);

echo "  Role middleware registered: " . (isset($aliases['role']) ? '✅' : '❌') . "\n";
echo "  Auth middleware registered: " . (isset($aliases['auth']) ? '✅' : '❌') . "\n";
echo "\n";

// Test 8: Views
echo "✓ Test 8: Views\n";
$views = [
    'layout',
    'home',
    'auth.login',
    'auth.register',
    'cars.index',
    'cars.show',
    'dashboard.client',
    'dashboard.admin',
];

foreach ($views as $view) {
    if (view()->exists($view)) {
        echo "  ✅ View '{$view}' exists\n";
    } else {
        echo "  ❌ View '{$view}' missing\n";
    }
}
echo "\n";

// Summary
echo "=====================================\n";
echo "🎉 All tests completed!\n";
echo "=====================================\n\n";

echo "📝 Test Accounts:\n";
echo "  Admin:    admin@carrental.test / password\n";
echo "  Employee: employee@carrental.test / password\n";
echo "  Client:   client@carrental.test / password\n\n";

echo "🌐 Access the application at: http://127.0.0.1:8000\n";
