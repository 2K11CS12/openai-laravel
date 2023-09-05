<?php

namespace Mangrio\OpenAiLaravel;

use Illuminate\Support\ServiceProvider;
//use Illuminate\Foundation\Console\AboutCommand;

class OpenAiLaravelServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/openai-laravel.php', 'openai-laravel'
        );
    }

    /**
     * Bootstrap any package services.
     */
    public function boot(): void
    {
        //AboutCommand::add('OpenAi Laravel', fn () => ['Version' => '1.0.0']);
        
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->publishes([
            __DIR__.'/../config/openai-laravel.php' => config_path('openai-laravel.php')
        ], 'openai-laravel-config');
     
        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations')
        ], 'openai-laravel-migrations');

    }

}
