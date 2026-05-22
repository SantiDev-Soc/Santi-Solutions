<?php
declare(strict_types=1);

namespace Santi\Leads\Domain\Events;

use Illuminate\Contracts\Queue\ShouldQueue;
use Santi\Shared\Domain\Bus\Event\DomainEvent;


class LeadCapturedDomainEvent extends DomainEvent implements ShouldQueue
{
    public function __construct(
        string $aggregateId,
        private string $name,
        private string $email,
        ?string $eventId = null,
        ?string $occurredOn = null
    )
    {
        parent::__construct($aggregateId, $eventId, $occurredOn);
    }

    public static function create(
        string $aggregateId,
        string $name,
        string $email
    ):self
    {
        return new self($aggregateId, $name, $email);
    }

    public function getName(): string
    {
        return 'lead.captured';
    }

    public function toPrimitives(): array
    {
        return [
            'name'  => $this->name,
            'email' => $this->email,
        ];
    }
}
