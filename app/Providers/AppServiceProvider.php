<?php

namespace App\Providers;

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
        /*Binds ChatKit method to Laravel's IoC (Inversion of Control) container.
          This makes the method resolvable from anywhere within the app. (less dependencies)*/
        $this->app->bind('Chat', function() {
            return new \Chatkit\Chatkit([
                'instance_locator' => config('services.chatkit.locator'),
                'key' => config('services.chatkit.secret'),
            ]);
        });
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
