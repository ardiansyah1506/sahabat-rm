<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
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
        'role',
        'avatar',
        'description',
        'active_start_date',
    ];

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function tasksAsAdmin()
    {
        return $this->hasMany(Task::class, 'admin_id');
    }

    public function tasksAsUser()
    {
        return $this->hasMany(Task::class, 'user_id');
    }

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
            'active_start_date' => 'date',
        ];
    }

    public function getActiveDaysAttribute()
    {
        $start = $this->active_start_date ?? $this->created_at;
        if (!$start) {
            return 0;
        }

        $startDate = \Carbon\Carbon::parse($start)->startOfDay();
        $today = \Carbon\Carbon::now()->startOfDay();

        return (int) $startDate->diffInDays($today);
    }

    public function getActiveDurationLabelAttribute()
    {
        $days = (int) $this->active_days;
        if ($days <= 0) {
            return 'Aktif Hari Ini';
        }
        return $days . ' Hari';
    }
}
