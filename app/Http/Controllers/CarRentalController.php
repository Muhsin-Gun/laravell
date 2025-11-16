<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarRentalController extends Controller
{
    private function getProducts()
    {
        return [
            ['id' => 1, 'name' => 'Mercedes-Benz S-Class', 'price' => 25000, 'category' => 'Luxury', 'rating' => 4.9, 'reviews' => 342, 'bookings' => 1240, 'desc' => 'Ultimate luxury sedan with chauffeur service', 'image' => '🚗', 'badge' => 'Premium', 'discount' => 15, 'specs' => ['seats' => 5, 'transmission' => 'Auto', 'fuel' => 'Hybrid'], 'features' => ['WiFi Hotspot', 'Mini Bar', 'Professional Driver', 'Airport Pickup']],
            ['id' => 2, 'name' => 'Range Rover Sport', 'price' => 22000, 'category' => 'SUV', 'rating' => 4.8, 'reviews' => 289, 'bookings' => 956, 'desc' => 'Premium SUV perfect for family trips', 'image' => '🚙', 'badge' => 'Popular', 'discount' => 20, 'specs' => ['seats' => 7, 'transmission' => 'Auto', 'fuel' => 'Diesel'], 'features' => ['4WD System', 'Panoramic Roof', 'Premium Sound', 'GPS Navigation']],
            ['id' => 3, 'name' => 'BMW 7 Series', 'price' => 23000, 'category' => 'Luxury', 'rating' => 4.9, 'reviews' => 456, 'bookings' => 1450, 'desc' => 'Executive sedan with cutting-edge technology', 'image' => '🚗', 'badge' => 'Top Rated', 'discount' => 10, 'specs' => ['seats' => 5, 'transmission' => 'Auto', 'fuel' => 'Hybrid'], 'features' => ['Executive Package', 'WiFi', 'Gesture Control', 'Premium Audio']],
            ['id' => 4, 'name' => 'Tesla Model S', 'price' => 18000, 'category' => 'Electric', 'rating' => 5.0, 'reviews' => 567, 'bookings' => 2100, 'desc' => 'Revolutionary electric sedan with autopilot', 'image' => '⚡', 'badge' => 'Eco', 'discount' => 25, 'specs' => ['seats' => 5, 'transmission' => 'Auto', 'fuel' => 'Electric'], 'features' => ['Autopilot', '0-100 in 2.1s', 'Free Supercharging', '600km Range']],
            ['id' => 5, 'name' => 'Porsche Cayenne', 'price' => 27000, 'category' => 'Sport', 'rating' => 4.8, 'reviews' => 298, 'bookings' => 845, 'desc' => 'Sports SUV combining performance with luxury', 'image' => '🏎', 'badge' => 'Performance', 'discount' => 10, 'specs' => ['seats' => 5, 'transmission' => 'PDK', 'fuel' => 'Petrol'], 'features' => ['Sport Chrono', 'Air Suspension', 'Bose Surround', 'Carbon Interior']],
            ['id' => 6, 'name' => 'Rolls-Royce Phantom', 'price' => 45000, 'category' => 'Ultra Luxury', 'rating' => 5.0, 'reviews' => 123, 'bookings' => 456, 'desc' => 'The pinnacle of luxury motoring', 'image' => '👑', 'badge' => 'Elite', 'discount' => 0, 'specs' => ['seats' => 5, 'transmission' => 'Auto', 'fuel' => 'V12'], 'features' => ['Starlight Headliner', 'Champagne Cooler', 'Picnic Tables', 'Bespoke Audio']],
        ];
    }

    public function index()
    {
        $products = $this->getProducts();
        return view('home', compact('products'));
    }

    public function marketplace(Request $request)
    {
        $products = $this->getProducts();
        
        if ($request->has('category') && $request->category !== 'all') {
            $products = array_filter($products, fn($p) => $p['category'] === $request->category);
        }
        
        if ($request->has('search') && $request->search !== '') {
            $products = array_filter($products, fn($p) => stripos($p['name'], $request->search) !== false);
        }
        
        return view('marketplace', compact('products'));
    }

    public function show($id)
    {
        $products = $this->getProducts();
        $product = collect($products)->firstWhere('id', (int)$id);
        
        if (!$product) abort(404);
        
        return view('product-detail', compact('product'));
    }

    public function addToCart(Request $request)
    {
        $cart = session()->get('cart', []);
        $productId = $request->product_id;
        
        if (isset($cart[$productId])) {
            $cart[$productId]['qty']++;
        } else {
            $products = $this->getProducts();
            $product = collect($products)->firstWhere('id', (int)$productId);
            $cart[$productId] = array_merge($product, ['qty' => 1]);
        }
        
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Added to cart!');
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);
        return redirect()->back();
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        return view('checkout', compact('cart'));
    }
}
