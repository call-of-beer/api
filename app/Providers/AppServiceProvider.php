<?php

namespace App\Providers;

use App\Models\Beer;
use App\Models\Comment;
use App\Models\Group;
use App\Models\Tasting;
use App\Models\User;
use App\Observers\BeerObserver;
use App\Observers\CommentObserver;
use App\Observers\GroupObserver;
use App\Observers\TastingObserver;
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
        Comment::observe(CommentObserver::class);
        Tasting::observe(TastingObserver::class);
    }
}
