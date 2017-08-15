<?php

namespace Empari\MailFinder\Providers;

use Illuminate\Support\ServiceProvider;
use Empari\MailFinder\Services\MailFinderIOService;
use Empari\MailFinder\Services\MailFinderServiceInterface;

class MailFinderServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Services
        $this->app->bind( MailFinderServiceInterface::class, MailFinderIOService::class);
        $this->app->singleton(MailFinderServiceInterface::class, function ($app) {
            return new MailFinderIOService(new \GuzzleHttp\Client);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}