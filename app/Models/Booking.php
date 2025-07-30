<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Property;
use App\Models\Room;
use App\Models\User;
use App\Models\Payment;
use App\Models\MaintenanceRequest;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'room_id',
        'student_id',
        'booking_reference',
        'check_in_date',
        'check_out_date',
        'duration_months',
        'monthly_rent',
        'security_deposit',
        'total_amount',
        'status',
        'booking_date',
        'special_requests',
        'assigned_room_number',
        'key_handover_date',
        'check_in_notes',
        'check_out_notes',
        'down_payment_amount',
        'tax',
        'service_fee',
        'subtotal',
    ];

    protected $casts = [
        'check_in_date' => 'date',
        'check_out_date' => 'date',
        'booking_date' => 'date',
        'key_handover_date' => 'date',
        'monthly_rent' => 'decimal:2',
        'security_deposit' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'down_payment_amount' => 'decimal:2',
        'tax' => 'decimal:2',
        'service_fee' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    // Relationships
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function contracts()
    {
        return $this->hasOne(Contract::class);
    }

    public function maintenanceRequests()
    {
        return $this->hasMany(MaintenanceRequest::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    // Accessors
    public function getIsActiveAttribute()
    {
        return $this->status === 'active';
    }

    public function getIsPendingAttribute()
    {
        return $this->status === 'pending';
    }

    public function getTotalPaidAttribute()
    {
        return $this->payments()->where('payment_status', 'completed')->sum('amount');
    }

    public function getOutstandingBalanceAttribute()
    {
        return $this->total_amount - $this->total_paid;
    }

    public function getRoomDisplayAttribute()
    {
        return $this->room ? $this->room->full_room_number : $this->assigned_room_number;
    }

    // Helper methods
    public function generateBookingReference()
    {
        return 'TK' . date('Y') . str_pad($this->id, 6, '0', STR_PAD_LEFT);
    }
}
