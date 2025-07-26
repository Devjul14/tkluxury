<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'content',
        'institute_specific',
        'institute_id',
        'minimum_duration_months',
        'is_active',
    ];

    protected $casts = [
        'institute_specific' => 'boolean',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function institute()
    {
        return $this->belongsTo(Institute::class);
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeGeneral($query)
    {
        return $query->where('institute_specific', false);
    }

    public function scopeInstituteSpecific($query)
    {
        return $query->where('institute_specific', true);
    }
}
