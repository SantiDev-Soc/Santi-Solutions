<?php
declare(strict_types=1);

namespace Santi\Leads\Infrastructure\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Santi\Leads\Domain\Repository\LeadRepositoryInterface;
use Santi\Leads\Infrastructure\Persistence\LeadRepository;

class LeadServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Movemos el binding del repositorio aquí para que sea modular
        $this->app->bind(LeadRepositoryInterface::class, LeadRepository::class);
    }

    public function boot(): void
    {
        // Cargamos las rutas del módulo
        $this->loadRoutes();
    }

    private function loadRoutes(): void
    {
        Route::middleware('api')//who cans in?
            ->prefix('api/leads')// where address go??
            ->group(base_path('src/Leads/Infrastructure/Http/routes.php'));
    }
}
