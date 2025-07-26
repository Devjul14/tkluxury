<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'institute_id',
        'student_id_number',
        'course_name',
        'year_of_study',
        'graduation_date',
        'budget_min',
        'budget_max',
        'preferred_property_types',
        'lifestyle_preferences',
        'roommate_preferences',
    ];

    protected $casts = [
        'graduation_date' => 'date',
        'budget_min' => 'decimal:2',
        'budget_max' => 'decimal:2',
        'preferred_property_types' => 'array',
        'lifestyle_preferences' => 'array',
        'roommate_preferences' => 'array',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function institute()
    {
        return $this->belongsTo(Institute::class);
    }

    // Scopes
    public function scopeByInstitute($query, $instituteId)
    {
        return $query->where('institute_id', $instituteId);
    }

    public function scopeByBudgetRange($query, $min, $max)
    {
        return $query->where('budget_min', '>=', $min)
                    ->where('budget_max', '<=', $max);
    }
}
