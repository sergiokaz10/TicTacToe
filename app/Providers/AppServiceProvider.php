<?php

namespace App\Providers;

use App\Contracts\MatchRepositoryInterface;
use App\Repositories\MatchRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(MatchRepositoryInterface::class, MatchRepository::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
