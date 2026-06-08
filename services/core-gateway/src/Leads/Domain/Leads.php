<?php
declare(strict_types=1);

namespace Santi\Leads\Domain;

use Santi\Shared\Domain\Aggregate\AggregateRoot;
use Santi\Leads\Domain\Events\LeadCapturedDomainEvent;
use Santi\Shared\Domain\ValueObject\LeadId;

class Leads extends AggregateRoot
{
    private LeadId $id;
    private string $name;
    private string $email;

    public function __construct(
        LeadId $id,
        string $name,
        string $email,
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }

    public static function create(
        LeadId $id,
        string $name,
        string $email,
    ):self
    {
        $lead = new self($id, $name, $email);
        $lead->recordDomainEvent(new LeadCapturedDomainEvent($id->getValue(), $name, $email));
        return $lead;
    }

    public function getId(): LeadId
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

}
