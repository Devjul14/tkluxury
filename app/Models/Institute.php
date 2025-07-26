<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institute extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'address',
        'city',
        'state',
        'country',
        'postal_code',
        'latitude',
        'longitude',
        'website',
        'contact_email',
        'contact_phone',
        'description',
        'logo',
        'partnership_status',
        'is_active',
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function studentProfiles()
    {
        return $this->hasMany(StudentProfile::class);
    }

    public function contractTemplates()
    {
        return $this->hasMany(ContractTemplate::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByPartnershipStatus($query, $status)
    {
        return $query->where('partnership_status', $status);
    }

    // Accessors
    public function getFullAddressAttribute()
    {
        return "{$this->address}, {$this->city}, {$this->state} {$this->postal_code}, {$this->country}";
    }
}
