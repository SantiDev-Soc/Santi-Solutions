<?php
declare(strict_types=1);

namespace Santi\Audit\Infrastructure\Providers;

use Santi\Audit\Application\Console\Commands\RedisAuditSubscriberCommand;
use Illuminate\Support\ServiceProvider;

class AuditServiceProvider extends ServiceProvider
{

    public function register(): void
    {
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                RedisAuditSubscriberCommand::class,
            ]);
        }
    }

    private function loadRoutes(): void
    {

    }
}
