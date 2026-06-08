<?php
declare(strict_types=1);

namespace Santi\Leads\Infrastructure\Persistence;

use app\Models\Lead;
use Santi\Leads\Domain\Leads;
use Santi\Leads\Domain\Repository\LeadRepositoryInterface;

class LeadRepository implements LeadRepositoryInterface
{

    public function save(Leads $lead): void
    {
        Lead::create([
            'id'    => $lead->getId()->getValue(),
            'name'  => $lead->getName(),
            'email' => $lead->getEmail(),
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
