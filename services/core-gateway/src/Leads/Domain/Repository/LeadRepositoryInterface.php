<?php
declare(strict_types=1);

namespace Santi\Leads\Domain\Repository;

use Santi\Leads\Domain\Leads;

interface LeadRepositoryInterface
{
    public function save(Leads $lead): void;

    public function update(Leads $lead): Leads;

    public function delete(Leads $lead): void;
}
