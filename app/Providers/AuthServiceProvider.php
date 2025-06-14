<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\DailyLog;
use App\Models\Habit;
use App\Models\HabitLog;
use App\Models\LifeEvent;
use App\Policies\DailyLogPolicy;
use App\Policies\HabitPolicy;
use App\Policies\HabitLogPolicy;
use App\Policies\LifeEventPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string|null>
     */
    protected $policies = [
        DailyLog::class => DailyLogPolicy::class,
        Habit::class => HabitPolicy::class,
        HabitLog::class => HabitLogPolicy::class,
        LifeEvent::class => LifeEventPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
