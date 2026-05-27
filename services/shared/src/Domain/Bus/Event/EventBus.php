<?php
declare(strict_types=1);

namespace Santi\Shared\Domain\Bus\Event;

interface EventBus
{
 public function publish(DomainEventInterface ...$events): void;
}
