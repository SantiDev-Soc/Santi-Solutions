<?php
declare(strict_types=1);

namespace Santi\Shared\Domain\Bus\Event;

use DateTimeImmutable;
use Symfony\Component\Uid\Uuid;

abstract class DomainEvent implements DomainEventInterface
{
    private string $eventId;
    private string $occurredOn;

    public function __construct(
        private readonly string $aggregateId,
        ?string $eventId = null,
        ?string $occurredOn = null
    )
    {
        $this->eventId = $eventId ?: (string)Uuid::v4();
        $this->occurredOn = $occurredOn ?: new DateTimeImmutable()->format('Y-m-d H:i:s');
    }

    public function getAggregateId(): string
    {
        return $this->aggregateId;
    }

    public function getOccurredOn(): string
    {
        return $this->occurredOn;
    }

    public function getEventId(): string
    {
        return $this->eventId;
    }

}
