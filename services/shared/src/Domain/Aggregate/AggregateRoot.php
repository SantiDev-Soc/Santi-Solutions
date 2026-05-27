<?php
declare(strict_types=1);

namespace Santi\Shared\Domain\Aggregate;

use Santi\Shared\Domain\Bus\Event\DomainEventInterface;

abstract class AggregateRoot
{
    protected array $domainEvents = [];

    final public function recordDomainEvent(DomainEventInterface $event): void
    {
        $this->domainEvents[] = $event;
    }

    final public function pullDomainEvents(): array
    {
        $events = $this->domainEvents;
        $this->domainEvents = [];

        return $events;
    }
}
