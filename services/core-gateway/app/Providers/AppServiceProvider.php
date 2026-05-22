<?php

namespace App\Providers;

use App\Jobs\RecordActivityJob;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
use Santi\Leads\Domain\Events\LeadCapturedDomainEvent;
use Santi\Shared\Domain\Bus\Event\EventBus;
use Santi\Leads\Domain\Repository\LeadRepositoryInterface;
use Santi\Leads\Infrastructure\LaravelEventBus;
use Santi\Leads\Infrastructure\Persistence\LeadRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //$this->app->bind(LeadRepositoryInterface::class, LeadRepository::class);
        $this->app->bind(EventBus::class, LaravelEventBus::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureDefaults();

        Event::listen(LeadCapturedDomainEvent::class, static function ($event) {
            RecordActivityJob::dispatch([
                'service' => 'gateway',
                'event' => 'LeadCaptured',
                'payload' => $event->toPrimitives()
            ]);
        });
    }

    /**
     * Configure default behaviors for production-ready applications.
     */
    protected function configureDefaults(): void
    {
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Password::defaults(static fn (): ?Password => app()->isProduction()
            ? Password::min(12)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()
            : null,
        );
    }
}
