<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'room_id',
        'booking_id',
        'student_id',
        'title',
        'description',
        'priority',
        'category',
        'status',
        'assigned_to_staff_id',
        'estimated_cost',
        'actual_cost',
        'completion_date',
        'student_rating',
        'photos',
    ];

    protected $casts = [
        'estimated_cost' => 'decimal:2',
        'actual_cost' => 'decimal:2',
        'completion_date' => 'date',
        'photos' => 'array',
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

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function assignedToStaff()
    {
        return $this->belongsTo(User::class, 'assigned_to_staff_id');
    }

    // Scopes
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeByPriority($query, $priority)
    {
        return $query->where('priority', $priority);
    }

    public function scopeUrgent($query)
    {
        return $query->where('priority', 'urgent');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeOpen($query)
    {
        return $query->whereIn('status', ['submitted', 'assigned', 'in_progress']);
    }

    public function getLocationDisplayAttribute()
    {
        if ($this->room) {
            return $this->room->full_room_number;
        }
        return $this->property->title;
    }
}
