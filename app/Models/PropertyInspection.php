<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyInspection extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'room_id',
        'inspector_staff_id',
        'inspection_type',
        'inspection_date',
        'overall_condition',
        'notes',
        'issues_found',
        'photos',
        'follow_up_required',
    ];

    protected $casts = [
        'inspection_date' => 'date',
        'issues_found' => 'array',
        'photos' => 'array',
        'follow_up_required' => 'boolean',
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

    public function inspectorStaff()
    {
        return $this->belongsTo(User::class, 'inspector_staff_id');
    }

    // Scopes
    public function scopeByInspectionType($query, $type)
    {
        return $query->where('inspection_type', $type);
    }

    public function scopeByCondition($query, $condition)
    {
        return $query->where('overall_condition', $condition);
    }

    public function scopeFollowUpRequired($query)
    {
        return $query->where('follow_up_required', true);
    }

    public function scopeRecent($query)
    {
        return $query->where('inspection_date', '>=', now()->subDays(30));
    }
}
