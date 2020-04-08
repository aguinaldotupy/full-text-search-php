<?php

namespace Tupy\FullTextSearch;

use Illuminate\Support\ServiceProvider;

class FullTextSearchServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('fulltextsearch', function () {
            return new FullTextSearch();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
