<?php

namespace App\Providers;

use App\Jobs\RecordActivityJob;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Santi\Leads\Domain\Events\LeadCapturedDomainEvent;

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
        Event::listen(LeadCapturedDomainEvent::class, static function ($event) {
            RecordActivityJob::dispatch([
                'service' => 'gateway',
                'event' => 'LeadCaptured',
                'payload' => $event->toPrimitives()
            ]);
        });
    }
}
