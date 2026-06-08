<?php
declare(strict_types=1);

namespace Santi\Shared\Infrastructure\Bus\Event;

use Illuminate\Support\Facades\Redis;
use JsonException;
use Santi\Shared\Domain\Bus\Event\DomainEvent;
use Santi\Shared\Domain\Bus\Event\DomainEventInterface;
use Santi\Shared\Domain\Bus\Event\EventBus;

class RedisEventBus implements EventBus
{
    private const string CHANNEL = 'santi_solutions_events';

    /** @throws JsonException */
    public function publish(DomainEventInterface ...$events): void
    {
        foreach ($events as $event) {
            if ($event instanceof DomainEvent) {
                Redis::publish(self::CHANNEL, $event->fullMessage());
            }
        }
    }
}
