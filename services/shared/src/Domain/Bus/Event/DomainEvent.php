<?php
declare(strict_types=1);

namespace Santi\Shared\Domain\Bus\Event;

use JsonException;
abstract class DomainEvent implements DomainEventInterface
{
    public function __construct(
        protected string $aggregateId,
        protected array $payload,
        protected ?string $occurredOn = null
    )
    {
        $this->occurredOn = $occurredOn ?: now()->toDateTimeString();
    }

    abstract public static function eventName(): string;

    /** @throws JsonException */
    public function fullMessage(): string
    {
        return json_encode([
            'event_name' => static::eventName(),
            'aggregate_id' => $this->aggregateId,
            'payload' => $this->payload,
            'occurred_on' => $this->occurredOn
        ], JSON_THROW_ON_ERROR);
    }
}
