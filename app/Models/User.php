<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Habit;
use App\Models\DailyLog;
use App\Models\Goal;
use App\Models\Collection;
use App\Models\SelfCareQuestion;
use App\Models\SelfCareCheckin;

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
        'birth_date',
        'gender',
        'phone',
        'bio',
        'goals_visibility',
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
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'birth_date' => 'date',
        'goals_visibility' => 'boolean',
    ];

    public function habits(): HasMany
    {
        return $this->hasMany(Habit::class);
    }

    public function dailyLogs(): HasMany
    {
        return $this->hasMany(DailyLog::class);
    }

    public function goals(): HasMany
    {
        return $this->hasMany(Goal::class);
    }

    public function collections()
    {
        return $this->hasMany(Collection::class);
    }

    public function questions()
    {
        return $this->hasMany(SelfCareQuestion::class);
    }

    public function checkins()
    {
        return $this->hasMany(SelfCareCheckin::class);
    }
}
