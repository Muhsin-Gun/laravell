<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy {{ $car->name }} - M-Pesa Payment</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto py-8 px-4">
        <div class="max-w-xl mx-auto">
            <div class="bg-orange-100 border border-orange-400 text-orange-700 px-4 py-3 rounded mb-4">
                <strong>SANDBOX MODE</strong> - This is a test payment form for development only. No real money will be charged.
            </div>
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                @if($car->image_path)
                <img src="{{ asset($car->image_path) }}" alt="{{ $car->name }}" class="w-full h-64 object-cover">
                @else
                <div class="w-full h-64 bg-gray-300 flex items-center justify-center">
                    <span class="text-gray-500">No Image Available</span>
                </div>
                @endif
                
                <div class="p-6">
                    <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $car->name }}</h1>
                    <p class="text-gray-600 mb-4">{{ $car->brand }} - {{ $car->type }}</p>
                    
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                        <p class="text-lg font-semibold text-green-800">
                            Price: KSH {{ number_format($car->price_per_day, 2) }} per day
                        </p>
                    </div>

                    @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        <strong>Success!</strong> {{ session('success') }}
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <strong>Error!</strong> {{ session('error') }}
                    </div>
                    @endif

                    @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul>
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('buy.car', $car) }}" method="POST" class="space-y-4">
                        @csrf
                        
                        <div>
                            <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-1">
                                M-Pesa Phone Number
                            </label>
                            <input type="text" 
                                   name="phone_number" 
                                   id="phone_number" 
                                   value="{{ old('phone_number', '+254793027220') }}"
                                   placeholder="+254 7XX XXX XXX"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                   required>
                            <p class="text-sm text-gray-500 mt-1">Enter your M-Pesa registered phone number</p>
                        </div>

                        <button type="submit" 
                                class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-lg transition duration-200">
                            Pay with M-Pesa
                        </button>
                    </form>

                    <div class="mt-6 text-center">
                        <a href="{{ route('cars.index') }}" class="text-green-600 hover:text-green-800">
                            &larr; Back to Cars
                        </a>
                    </div>
                </div>
            </div>

            <div class="mt-6 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                <h3 class="font-semibold text-yellow-800 mb-2">How it works:</h3>
                <ol class="list-decimal list-inside text-sm text-yellow-700 space-y-1">
                    <li>Enter your M-Pesa registered phone number</li>
                    <li>Click "Pay with M-Pesa"</li>
                    <li>You will receive an STK push on your phone</li>
                    <li>Enter your M-Pesa PIN to complete payment</li>
                </ol>
            </div>
        </div>
    </div>
</body>
</html>
