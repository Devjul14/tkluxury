<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'user_type',
        'profile_image',
        'date_of_birth',
        'gender',
        'nationality',
        'emergency_contact_name',
        'emergency_contact_phone',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'date_of_birth' => 'date',
            'is_active' => 'boolean',
        ];
    }

    // Relationships
    public function studentProfile()
    {
        return $this->hasOne(StudentProfile::class);
    }

    public function staff()
    {
        return $this->hasOne(Staff::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'student_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'student_id');
    }

    public function maintenanceRequests()
    {
        return $this->hasMany(MaintenanceRequest::class, 'student_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByUserType($query, $type)
    {
        return $query->where('user_type', $type);
    }

    // Accessors
    public function getIsStudentAttribute()
    {
        return $this->user_type === 'student';
    }

    public function getIsAdminAttribute()
    {
        return $this->user_type === 'admin';
    }

    public function getIsStaffAttribute()
    {
        return $this->user_type === 'staff';
    }
}
