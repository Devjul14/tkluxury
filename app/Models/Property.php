<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'institute_id',
        'property_code',
        'title',
        'description',
        'property_type',
        'address',
        'city',
        'state',
        'postal_code',
        'latitude',
        'longitude',
        'distance_to_institute',
        'total_rooms',
        'available_rooms',
        'price_per_month',
        'security_deposit',
        'utility_costs_included',
        'furnished',
        'lease_duration_min',
        'lease_duration_max',
        'available_from',
        'available_until',
        'is_active',
        'maintenance_status',
        'property_manager_notes',
        'acquisition_date',
        'monthly_expenses',
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'distance_to_institute' => 'decimal:3',
        'price_per_month' => 'decimal:2',
        'security_deposit' => 'decimal:2',
        'monthly_expenses' => 'decimal:2',
        'utility_costs_included' => 'boolean',
        'furnished' => 'boolean',
        'is_active' => 'boolean',
        'available_from' => 'date',
        'available_until' => 'date',
        'acquisition_date' => 'date',
    ];

    // Relationships
    public function institute()
    {
        return $this->belongsTo(Institute::class);
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'property_features');
    }

    public function images()
    {
        return $this->hasMany(PropertyImage::class);
    }

    public function nearbyPlaces()
    {
        return $this->hasMany(NearbyPlace::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function maintenanceRequests()
    {
        return $this->hasMany(MaintenanceRequest::class);
    }

    public function inspections()
    {
        return $this->hasMany(PropertyInspection::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeAvailable($query)
    {
        return $query->where('available_rooms', '>', 0);
    }

    public function scopeByPropertyType($query, $type)
    {
        return $query->where('property_type', $type);
    }

    public function scopeByPriceRange($query, $min, $max)
    {
        return $query->whereBetween('price_per_month', [$min, $max]);
    }

    // Accessors
    public function getFullAddressAttribute()
    {
        return "{$this->address}, {$this->city}, {$this->state} {$this->postal_code}";
    }

    public function getOccupancyRateAttribute()
    {
        $occupiedRooms = $this->total_rooms - $this->available_rooms;
        return $this->total_rooms > 0 ? ($occupiedRooms / $this->total_rooms) * 100 : 0;
    }

    public function getAverageRatingAttribute()
    {
        return $this->reviews()->avg('overall_rating') ?? 0;
    }

    public function getPrimaryImageAttribute()
    {
        return $this->images()->where('is_primary', true)->first();
    }

    public function getAvailableRoomsCountAttribute()
    {
        return $this->rooms()->where('is_available', true)->count();
    }

    public function getOccupiedRoomsCountAttribute()
    {
        return $this->rooms()->where('is_available', false)->count();
    }

    public function getTotalRevenueFromRoomsAttribute()
    {
        return $this->rooms()->with('bookings')->get()->sum(function ($room) {
            return $room->bookings()->where('status', 'active')->sum('monthly_rent');
        });
    }
}
