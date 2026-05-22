<?php
declare(strict_types=1);

namespace Santi\Leads\Domain\ValueObjects;

use Santi\Shared\Domain\ValueObject\AggregateRootId;
use Symfony\Component\Uid\Uuid;

class LeadId extends AggregateRootId
{
    public static function create(string $value): self
    {
        return new self($value);
    }

    public static function random(): self
    {
        return new self((string)Uuid::v4());
    }
}
