<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'student_id',
        'booking_id',
        'overall_rating',
        'cleanliness_rating',
        'location_rating',
        'value_rating',
        'management_rating',
        'title',
        'comment',
        'admin_response',
        'is_verified',
        'is_featured',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'is_featured' => 'boolean',
    ];

    // Relationships
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    // Scopes
    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByRating($query, $rating)
    {
        return $query->where('overall_rating', $rating);
    }

    public function scopeHighRated($query)
    {
        return $query->where('overall_rating', '>=', 4);
    }

    // Accessors
    public function getAverageSubRatingAttribute()
    {
        $ratings = [
            $this->cleanliness_rating,
            $this->location_rating,
            $this->value_rating,
            $this->management_rating
        ];
        return round(array_sum($ratings) / count($ratings), 1);
    }
}
