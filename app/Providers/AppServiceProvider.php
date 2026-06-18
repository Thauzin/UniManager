<?php
namespace App\Providers;

use App\Modules\AccessLevels\Models\AccessLevel;
use App\Modules\CourseAreas\Models\CourseArea;
use App\Modules\Courses\Models\Course;
use App\Modules\Users\Models\User;
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
        $course_areas  = CourseArea::get();
        $course        = Course::get();
        $access_levels = AccessLevel::get();
        $users         = User::get();

        View::share('course_areas', $course_areas);
        View::share('course', $course);
        View::share('access_levels', $access_levels);
        View::share('users', $users);

        Blade::if('access', function ($levels) {

            $levels = is_array($levels) ? $levels : [$levels];

            return auth()->check()
            && in_array(auth()->user()->access_level_id, $levels);
        });

        View::composer('*', function ($view) {
            if (auth()->check()) {
                $user = auth()->user()->load('access_level');
                $view->with('user', $user);
            }
        });
    }
}
