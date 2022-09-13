<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\ThirdParty\CardanoClients\ICardanoClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->app->bind(ICardanoClient::class, config('gatekeeper.cardanoClient'));
    }
}
