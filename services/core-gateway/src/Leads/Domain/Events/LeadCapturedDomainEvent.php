<?php
declare(strict_types=1);

namespace Santi\Leads\Domain\Events;

use Santi\Leads\Domain\Enum\LeadStatusEnum;
use Santi\Shared\Domain\Bus\Event\DomainEvent;

class LeadCapturedDomainEvent extends DomainEvent
{
    private static $leadCapturedDomainEvent;

    public function __construct(
        string $aggregateId,
        private readonly string $name,
        private readonly string $email,
        private readonly string $phone,
        private readonly string $zip_code,
        private readonly string $interest,
        private readonly LeadStatusEnum $status,
        private readonly string $budget_estimate,
        ?string $eventId = null,
        ?string $occurredOn = null
    )
    {
        parent::__construct($aggregateId, $this->toPrimitives(), $occurredOn);
    }

    public static function create(
        string $aggregateId,
        string $name,
        string $email,
        string $phone,
        string $zip_code,
        string $interest,
        LeadStatusEnum $status,
        string $budget_estimate,
    ): self
    {
        return new self(
            $aggregateId,
            $name,
            $email,
            $phone,
            $zip_code,
            $interest,
            $status,
            $budget_estimate,
        );
    }

    public function toPrimitives(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'zip_code' => $this->zip_code,
            'interest' => $this->interest,
            'status' => $this->status->getValue(),
            'budget_estimate' => $this->budget_estimate,
        ];
    }

    public static function eventName(): string
    {
        return 'lead.captured';
    }
}
