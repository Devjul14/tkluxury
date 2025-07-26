<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'property_id',
        'room_number',
        'room_type',
        'floor_number',
        'size_sqm',
        'capacity',
        'price_per_month',
        'security_deposit',
        'is_available',
        'is_furnished',
        'has_private_bathroom',
        'has_balcony',
        'has_air_conditioning',
        'has_heating',
        'description',
        'amenities',
        'maintenance_status',
        'last_inspection_date',
        'notes',
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'is_furnished' => 'boolean',
        'has_private_bathroom' => 'boolean',
        'has_balcony' => 'boolean',
        'has_air_conditioning' => 'boolean',
        'has_heating' => 'boolean',
        'amenities' => 'array',
        'last_inspection_date' => 'date',
        'price_per_month' => 'decimal:2',
        'security_deposit' => 'decimal:2',
        'size_sqm' => 'decimal:2',
    ];

    // Relationships
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function maintenanceRequests(): HasMany
    {
        return $this->hasMany(MaintenanceRequest::class);
    }

    public function inspections(): HasMany
    {
        return $this->hasMany(PropertyInspection::class);
    }

    // Scopes
    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }

    public function scopeOccupied($query)
    {
        return $query->where('is_available', false);
    }

    public function scopeByProperty($query, $propertyId)
    {
        return $query->where('property_id', $propertyId);
    }

    public function scopeByRoomType($query, $roomType)
    {
        return $query->where('room_type', $roomType);
    }

    public function scopeByPriceRange($query, $minPrice, $maxPrice)
    {
        return $query->whereBetween('price_per_month', [$minPrice, $maxPrice]);
    }

    public function scopeFurnished($query)
    {
        return $query->where('is_furnished', true);
    }

    public function scopeWithPrivateBathroom($query)
    {
        return $query->where('has_private_bathroom', true);
    }

    // Helper methods
    public function getFullRoomNumberAttribute(): string
    {
        return $this->property->property_code . '-' . $this->room_number;
    }

    public function getOccupancyStatusAttribute(): string
    {
        return $this->is_available ? 'Available' : 'Occupied';
    }

    public function getTotalRevenueAttribute(): float
    {
        return $this->bookings()->sum('total_amount');
    }

    public function getCurrentBookingAttribute()
    {
        return $this->bookings()
            ->where('status', 'active')
            ->first();
    }

    public function getCurrentStudentAttribute()
    {
        $currentBooking = $this->getCurrentBookingAttribute();
        return $currentBooking ? $currentBooking->student : null;
    }

    public function getMaintenanceStatusColorAttribute(): string
    {
        return match ($this->maintenance_status) {
            'excellent' => 'success',
            'good' => 'info',
            'fair' => 'warning',
            'under_maintenance' => 'danger',
            default => 'gray',
        };
    }

    public function getRoomTypeLabelAttribute(): string
    {
        return match ($this->room_type) {
            'single' => 'Single Room',
            'double' => 'Double Room',
            'triple' => 'Triple Room',
            'quad' => 'Quad Room',
            'studio' => 'Studio',
            'suite' => 'Suite',
            default => ucfirst($this->room_type),
        };
    }

    public function getAmenitiesListAttribute(): array
    {
        $amenities = [];
        
        if ($this->is_furnished) $amenities[] = 'Furnished';
        if ($this->has_private_bathroom) $amenities[] = 'Private Bathroom';
        if ($this->has_balcony) $amenities[] = 'Balcony';
        if ($this->has_air_conditioning) $amenities[] = 'Air Conditioning';
        if ($this->has_heating) $amenities[] = 'Heating';
        
        return array_merge($amenities, $this->amenities ?? []);
    }

    public function isCurrentlyOccupied(): bool
    {
        return $this->bookings()
            ->where('status', 'active')
            ->where('check_in_date', '<=', now())
            ->where('check_out_date', '>=', now())
            ->exists();
    }

    public function getDaysUntilAvailableAttribute(): ?int
    {
        $currentBooking = $this->bookings()
            ->where('status', 'active')
            ->where('check_out_date', '>', now())
            ->first();

        return $currentBooking ? now()->diffInDays($currentBooking->check_out_date) : null;
    }

    public function getMonthlyRevenueAttribute(): float
    {
        return $this->bookings()
            ->where('status', 'active')
            ->sum('monthly_rent');
    }

    public function getOccupancyRateAttribute(): float
    {
        $totalDays = now()->diffInDays($this->created_at) ?: 1;
        $occupiedDays = $this->bookings()
            ->where('status', 'active')
            ->get()
            ->sum(function ($booking) {
                return $booking->check_in_date->diffInDays($booking->check_out_date);
            });

        return min(100, ($occupiedDays / $totalDays) * 100);
    }
}
