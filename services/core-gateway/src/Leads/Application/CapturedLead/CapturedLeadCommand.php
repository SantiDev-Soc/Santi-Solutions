<?php
declare(strict_types=1);

namespace Santi\Leads\Application\CapturedLead;


use Santi\Leads\Domain\ValueObjects\LeadId;
use Santi\Shared\Application\Bus\Command\CommandInterface;

class CapturedLeadCommand implements CommandInterface
{
    public function __construct(
        public LeadId $leadId,
        public string $name,
        public string $email,
    )
    {
    }
}
