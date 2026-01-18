<?php

namespace App\Providers;

use App\Livewire\BuscaProdutos;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Registrar componente Livewire explicitamente
        Livewire::component('busca-produtos', BuscaProdutos::class);
    }
}

