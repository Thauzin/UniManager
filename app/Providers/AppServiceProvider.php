<?php
namespace App\Providers;

use App\Modules\AccessLevels\Models\AccessLevel;
use App\Modules\Centers\Models\Center;
use App\Modules\Notifications\Models\Notification;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // $notifications = Notification::whereNull('viewed_at')->get();
        $access_levels = AccessLevel::get();

        // View::share('notifications', $notifications);
        View::share('access_levels', $access_levels);

        Blade::if('access', function ($levels) {

            $levels = is_array($levels) ? $levels : [$levels];

            return auth()->check()
            && in_array(auth()->user()->access_level_id, $levels);
        });
    }
}
