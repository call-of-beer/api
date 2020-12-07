<?php

namespace App\Providers;

use App\Models\Beer;
use App\Models\Group;
use App\Models\User;
use App\Observers\BeerObserver;
use App\Observers\GroupObserver;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        Beer::observe(BeerObserver::class);
        Group::observe(GroupObserver::class);
    }
}
