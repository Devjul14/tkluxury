<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'image_path',
        'alt_text',
        'is_primary',
        'room_type',
        'sort_order',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
    ];

    // Relationships
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    // Scopes
    public function scopePrimary($query)
    {
        return $query->where('is_primary', true);
    }

    public function scopeByRoomType($query, $roomType)
    {
        return $query->where('room_type', $roomType);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }
}
