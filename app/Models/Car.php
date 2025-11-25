<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'name',
        'brand',
        'type',
        'description',
        'price_per_day',
        'image_path',
        'available',
        'features'
    ];

    protected $casts = [
        'features' => 'json',
        'available' => 'boolean'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Backwards-compatible accessor for legacy attribute `make`.
     * Returns the `brand` field so old views using `$car->make` keep working.
     */
    public function getMakeAttribute()
    {
        return $this->attributes['brand'] ?? null;
    }

    /**
     * Backwards-compatible accessor for legacy attribute `model`.
     * Returns the `name` field so old views using `$car->model` keep working.
     */
    public function getModelAttribute()
    {
        return $this->attributes['name'] ?? null;
    }

    /**
     * Backwards-compatible accessor for legacy attribute `image`.
     * Returns the `image_path` field so old views using `$car->image` keep working.
     */
    public function getImageAttribute()
    {
        return $this->attributes['image_path'] ?? null;
    }

    /**
     * Backwards-compatible accessor for legacy attribute `price`.
     * Returns the `price_per_day` field so old views using `$car->price` keep working.
     */
    public function getPriceAttribute()
    {
        return $this->attributes['price_per_day'] ?? null;
    }
}
