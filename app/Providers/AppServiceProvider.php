<?php

namespace App\Providers;

use App\Models\Menu;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (DB::connection()->getDriverName() === 'mysql') {
            Schema::defaultStringLength(191);
        }

        Paginator::useBootstrapFive();

        // Admin role bypasses all permission checks
        Gate::before(function ($user, $ability) {
            return $user->hasRole('Admin') ? true : null;
        });

        // Share sidebar menus with all authenticated views
        View::composer('layouts.partials.sidebar', function ($view) {
            try {
                $sidebarMenus = Menu::whereNull('parent_id')
                    ->where('is_active', true)
                    ->with(['activeChildren'])
                    ->orderBy('sort_order')
                    ->get();
            } catch (\Exception $e) {
                $sidebarMenus = collect();
            }
            $view->with('sidebarMenus', $sidebarMenus);
        });
    }
}
