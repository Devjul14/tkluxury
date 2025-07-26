<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NearbyPlace extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'name',
        'category',
        'distance',
        'walking_time',
    ];

    // Relationships
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    // Scopes
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeWithinDistance($query, $maxDistance)
    {
        return $query->where('distance', '<=', $maxDistance);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('distance');
    }
}
