<?php

namespace Trippledee\ContactForm;

use Illuminate\Support\ServiceProvider;

class ContactFormServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/contact-form.php', 'contact-form');
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'contact-form');

        $this->publishes([
            __DIR__.'/../config/contact-form.php' => config_path('contact-form.php'),
        ], 'contact-form-config');
    }
}
