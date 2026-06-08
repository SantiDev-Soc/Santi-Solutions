<?php
declare(strict_types=1);

namespace Santi\Leads\Infrastructure\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Santi\Leads\Domain\Repository\LeadRepositoryInterface;
use Santi\Leads\Domain\Repository\ProjectProjectionRepositoryInterface;
use Santi\Leads\Infrastructure\Persistence\LeadRepository;
use Santi\Leads\Infrastructure\Persistence\ProjectProjectionRepository;
use Santi\Shared\Domain\Bus\Event\EventBus;
use Santi\Shared\Infastructure\Bus\Event\RedisEventBus;

class LeadServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(LeadRepositoryInterface::class, LeadRepository::class);
        $this->app->bind(EventBus::class, RedisEventBus::class);
        $this->app->bind(
        ProjectProjectionRepositoryInterface::class,
        ProjectProjectionRepository::class);
    }

    public function boot(): void
    {
        $this->loadRoutes();
        if ($this->app->runningInConsole()) {
            $this->commands([
            ]);
        }
    }

    private function loadRoutes(): void
    {
        Route::middleware('api')
            ->prefix('api/leads')
            ->group(base_path('src/Leads/Infrastructure/Http/routes.php'));
    }
}
