<?php
declare(strict_types=1);

namespace Santi\Leads\Infrastructure;

use Santi\Shared\Domain\Bus\Event\DomainEvent;
use Santi\Shared\Domain\Bus\Event\EventBus;
use Illuminate\Support\Facades\Event;


class LaravelEventBus implements EventBus
{
    public function publish(DomainEvent ...$events): void
    {
        foreach ($events as $event) {
            Event::dispatch($event);
        }
    }
}
