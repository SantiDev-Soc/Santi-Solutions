<?php
declare(strict_types=1);

namespace Santi\Exterior\Infrastructure\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Santi\Shared\Domain\Bus\Event\EventBus;
use Santi\Shared\Infrastructure\Bus\Event\RedisEventBus;

class ExteriorServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(EventBus::class, RedisEventBus::class);
    }

    public function boot(): void
    {
        $this->loadRoutes();

        if ($this->app->runningInConsole()) {
            $this->commands([
                \Santi\Exterior\Infrastructure\Console\Commands\RedisExteriorSubscriberCommand::class,
            ]);
        }
    }

    private function loadRoutes(): void
    {
        Route::middleware('api')
            ->prefix('api/exterior')
            ->group(base_path('src/Exterior/Infrastructure/Http/routes.php'));
    }
}
