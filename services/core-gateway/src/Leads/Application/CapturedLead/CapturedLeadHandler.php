<?php
declare(strict_types=1);

namespace Santi\Leads\Application\CapturedLead;

use Santi\Leads\Domain\Leads;
use Santi\Leads\Domain\Repository\LeadRepositoryInterface;
use Santi\Leads\Infrastructure\LaravelEventBus;

final readonly class CapturedLeadHandler
{
    public function __construct(
        private LeadRepositoryInterface $leadRepository,
        private LaravelEventBus $eventBus,
    )
    {
    }

    public function __invoke(CapturedLeadCommand $command): void
    {
        $lead = Leads::create(
            $command->leadId,
            $command->name,
            $command->email,
        );

        $this->leadRepository->save($lead);

        $this->eventBus->publish(...$lead->pullDomainEvents());
    }
}
