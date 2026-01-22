<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Appointment;
use App\Models\SpecialAppointment;
use App\Models\CheckResult;
use App\Models\NavtechAppointment;
use App\Models\TasheerAppointment;
use App\Models\SoftSkillCertificate;
use App\Models\ContactInquiry;
use App\Models\Setting;
use App\Models\MedicalCenter;
use Illuminate\Pagination\Paginator;

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
        Paginator::useBootstrapFour();

        // Share counts with the admin layout view (assuming your file is 'admin.blade.php' or inside layouts)
        // Note: Replace 'admin.blade.php' with the actual path if it's in a folder, e.g., 'layouts.admin'
        // Using '*' shares it with ALL views, which is safest for the sidebar.
        View::composer('*', function ($view) {
            
            $counts = [
                'wafid_new'     => Appointment::where('is_new', 1)->count(),
                'special_new'   => SpecialAppointment::where('is_new', 1)->count(),
                'medical_new'   => CheckResult::where('is_new', 1)->count(),
                'navtech_new'   => NavtechAppointment::where('is_new', 1)->count(),
                'tasheer_new'   => TasheerAppointment::where('is_new', 1)->count(),
                'softskill_new' => SoftSkillCertificate::where('is_new', 1)->count(),
                'contact_new'   => ContactInquiry::where('is_new', 1)->count(),
            ];

            $view->with($counts);
        });

        // Share Website Settings with ALL views
        View::composer('*', function ($view) {
            $settings = Setting::pluck('value', 'key')->toArray();
            $view->with('settings', $settings);
        });

        // Share unique cities for public dropdown
        View::composer('layouts.public', function ($view) {
            $all_cities = MedicalCenter::distinct()->pluck('city')->sort();
            $view->with('all_cities', $all_cities);
        });
    }
}
