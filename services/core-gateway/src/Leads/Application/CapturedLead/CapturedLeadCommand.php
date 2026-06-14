<?php
declare(strict_types=1);

namespace Santi\Leads\Application\CapturedLead;

use Santi\Shared\Application\Bus\Command\CommandInterface;
use Santi\Shared\Domain\ValueObject\LeadId;

class CapturedLeadCommand implements CommandInterface
{
    public function __construct(
        public LeadId $leadId,
        public string $name,
        public string $email,
        public string $phone,
        public string $zipCode,
        public string $interest,
        public ?string $budget_estimate,
    )
    {
    }
}
