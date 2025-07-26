<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'role',
        'properties_assigned',
        'phone_work',
        'emergency_contact',
        'hire_date',
        'is_active',
    ];

    protected $casts = [
        'properties_assigned' => 'array',
        'hire_date' => 'date',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function processedPayments()
    {
        return $this->hasMany(Payment::class, 'processed_by_staff_id');
    }

    public function assignedMaintenanceRequests()
    {
        return $this->hasMany(MaintenanceRequest::class, 'assigned_to_staff_id');
    }

    public function propertyInspections()
    {
        return $this->hasMany(PropertyInspection::class, 'inspector_staff_id');
    }

    public function signedContracts()
    {
        return $this->hasMany(Contract::class, 'signed_by_staff_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByRole($query, $role)
    {
        return $query->where('role', $role);
    }

    public function scopePropertyManagers($query)
    {
        return $query->where('role', 'property_manager');
    }

    public function scopeMaintenanceStaff($query)
    {
        return $query->where('role', 'maintenance');
    }

    // Accessors
    public function getAssignedPropertiesCountAttribute()
    {
        return is_array($this->properties_assigned) ? count($this->properties_assigned) : 0;
    }
}
