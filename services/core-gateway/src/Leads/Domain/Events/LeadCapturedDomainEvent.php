<?php
declare(strict_types=1);

namespace Santi\Leads\Domain\Events;

use Santi\Shared\Domain\Bus\Event\DomainEvent;

class LeadCapturedDomainEvent extends DomainEvent
{
    public function __construct(
        string $aggregateId,
        private string $name,
        private string $email,
        ?string $eventId = null,
        ?string $occurredOn = null
    )
    {
        parent::__construct($aggregateId, $this->toPrimitives(), $occurredOn);
    }

    public static function create(
        string $aggregateId,
        string $name,
        string $email
    ): self
    {
        return new self($aggregateId, $name, $email);
    }

    public function toPrimitives(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
        ];
    }

    public static function eventName(): string
    {
        return 'lead.captured';
    }
}
