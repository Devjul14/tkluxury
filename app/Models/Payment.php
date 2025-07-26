<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'payment_type',
        'amount',
        'payment_method',
        'payment_status',
        'transaction_id',
        'payment_date',
        'due_date',
        'stripe_payment_intent_id',
        'late_fee_applied',
        'notes',
        'processed_by_staff_id',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'payment_date' => 'date',
        'due_date' => 'date',
        'late_fee_applied' => 'boolean',
    ];

    // Relationships
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function processedByStaff()
    {
        return $this->belongsTo(User::class, 'processed_by_staff_id');
    }

    // Scopes
    public function scopeCompleted($query)
    {
        return $query->where('payment_status', 'completed');
    }

    public function scopePending($query)
    {
        return $query->where('payment_status', 'pending');
    }

    public function scopeFailed($query)
    {
        return $query->where('payment_status', 'failed');
    }

    public function scopeByPaymentType($query, $type)
    {
        return $query->where('payment_type', $type);
    }

    public function scopeOverdue($query)
    {
        return $query->where('due_date', '<', now())
                    ->where('payment_status', '!=', 'completed');
    }

    // Accessors
    public function getIsCompletedAttribute()
    {
        return $this->payment_status === 'completed';
    }

    public function getIsPendingAttribute()
    {
        return $this->payment_status === 'pending';
    }

    public function getIsOverdueAttribute()
    {
        return $this->due_date < now() && $this->payment_status !== 'completed';
    }
}
