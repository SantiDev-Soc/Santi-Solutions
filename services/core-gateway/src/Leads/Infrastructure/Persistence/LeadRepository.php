<?php
declare(strict_types=1);

namespace Santi\Leads\Infrastructure\Persistence;

use Santi\Leads\Domain\Leads;
use Santi\Leads\Domain\Repository\LeadRepositoryInterface;

class LeadRepository implements LeadRepositoryInterface
{

    public function save(Leads $lead): void
    {
        \App\Models\Lead::create([
            'id'              => $lead->getId()->getValue(),
            'name'            => $lead->getName(),
            'email'           => $lead->getEmail(),
            'phone'           => $lead->getPhone(),
            'zip_code'        => $lead->getZipCode(),
            'interest'        => $lead->getInterest(),
            'status'          => $lead->getStatus()->getValue(),
            'budget_estimate' => $lead->getBudgetEstimate(),
        ]);
    }

    public function update(Leads $lead): Leads
    {
        // TODO: Implement update() method.
    }

    public function delete(Leads $lead): void
    {
        // TODO: Implement delete() method.
    }
}
