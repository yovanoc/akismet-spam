<?php

namespace Chrisyoyo\AkismetSpam;

use Illuminate\Support\ServiceProvider;
use Chrisyoyo\AkismetSpam\Service\AkismetSpamService;
use Chrisyoyo\AkismetSpam\Service\SpamServiceInterface;

class SpamServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/akismet-spam.php' => config_path('akismet-spam.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(SpamServiceInterface::class, function ($app) {
            return new AkismetSpamService(new \GuzzleHttp\Client);
        });
    }
}
