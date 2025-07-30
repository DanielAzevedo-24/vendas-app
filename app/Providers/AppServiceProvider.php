<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Forçar HTTPS se quiser (descomente abaixo em produção)
        // URL::forceScheme('https');

        // Exemplo: setar fuso horário padrão do Carbon (opcional)
        // date_default_timezone_set('America/Sao_Paulo');
    }
}
