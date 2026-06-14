<?php
declare(strict_types=1);

namespace Santi\Leads\Domain;

use Santi\Leads\Domain\Enum\LeadStatusEnum;
use Santi\Shared\Domain\Aggregate\AggregateRoot;
use Santi\Leads\Domain\Events\LeadCapturedDomainEvent;
use Santi\Shared\Domain\ValueObject\LeadId;

class Leads extends AggregateRoot
{
    private LeadId $id;
    private string $name;
    private string $email;
    private string $phone;
    private string $zip_code;
    private string $interest;
    private LeadStatusEnum $status;
    private ?string $budget_estimate;

    public function __construct(
        LeadId $id,
        string $name,
        string $email,
        string $phone,
        string $zip_code,
        string $interest,
        LeadStatusEnum $status,
        ?string $budget_estimate
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->zip_code = $zip_code;
        $this->interest = $interest;
        $this->status = $status;
        $this->budget_estimate = $budget_estimate;
    }

    public static function create(
        LeadId $id,
        string $name,
        string $email,
        string $phone,
        string $zip_code,
        string $interest,
        LeadStatusEnum $status,
        ?string $budget_estimate = null
    ):self
    {
        $lead = new self($id, $name, $email, $phone, $zip_code, $interest, $status, $budget_estimate);
        $lead->recordDomainEvent(new LeadCapturedDomainEvent(
            $id->getValue(),
            $name,
            $email,
            $phone,
            $zip_code,
            $interest,
            $status,
            $budget_estimate
        ));

        return $lead;
    }

    public function getBudgetEstimate(): ?string
    {
        return $this->budget_estimate;
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

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getZipCode(): string
    {
        return $this->zip_code;
    }

    public function getInterest(): string
    {
        return $this->interest;
    }

    public function getStatus(): LeadStatusEnum
    {
        return $this->status;
    }
}
