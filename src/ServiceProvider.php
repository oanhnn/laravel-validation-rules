<?php

namespace Laravel\Validation;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class ServiceProvider extends IlluminateServiceProvider
{
    /**
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../resources/lang' => resource_path('lang/vendor/validation-rules'),
            ]);
        }

        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang/', 'validation-rules');
    }
}
