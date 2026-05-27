<?php
declare(strict_types=1);

namespace Santi\Leads\Application\Console\Commands;

use Illuminate\Console\Command;
use Santi\Leads\Domain\Events\LeadCapturedDomainEvent;
use Santi\Shared\Domain\Bus\Event\EventBus;
use Symfony\Component\Uid\Uuid;

class TestEventSystemCommand extends Command
{
    /** @var string */
    protected $signature = 'santi:test-event-system';

    /** @var string */
    protected $description = 'sent a test lead to event bus';

    public function __construct(private readonly EventBus $eventBus)
    {
        parent::__construct();
    }

    /** Execute the console command. */
    public function handle(): void
    {
        $event = LeadCapturedDomainEvent::create(
            (string) Uuid::v4(),
            "Prueba desde Gateway",
            "test@santisolutions.com"
        );

        $this->eventBus->publish($event);

        $this->info("Evento enviado a Redis correctamente via Pub/Sub.");
    }
}
