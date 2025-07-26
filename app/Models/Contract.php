<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'contract_number',
        'contract_template_id',
        'generated_content',
        'file_path',
        'status',
        'signed_by_student_at',
        'signed_by_staff_id',
        'staff_signature_date',
        'termination_reason',
    ];

    protected $casts = [
        'generated_content' => 'array',
        'signed_by_student_at' => 'datetime',
        'staff_signature_date' => 'datetime',
    ];

    // Relationships
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function contractTemplate()
    {
        return $this->belongsTo(ContractTemplate::class);
    }

    public function signedByStaff()
    {
        return $this->belongsTo(User::class, 'signed_by_staff_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeSigned($query)
    {
        return $query->where('status', 'signed');
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // Accessors
    public function getIsSignedAttribute()
    {
        return $this->status === 'signed';
    }

    public function getIsActiveAttribute()
    {
        return $this->status === 'active';
    }

    // Helper methods
    public function generateContractNumber()
    {
        return 'CON' . date('Y') . str_pad($this->id, 6, '0', STR_PAD_LEFT);
    }
}
