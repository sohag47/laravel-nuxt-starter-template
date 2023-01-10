<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Contracts\RepositoryInterface;
use App\Repositories\BaseRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(RepositoryInterface::class, BaseRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
