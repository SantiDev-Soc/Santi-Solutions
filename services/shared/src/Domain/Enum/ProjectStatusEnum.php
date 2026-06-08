<?php
declare(strict_types=1);

namespace Santi\Shared\Domain\Enum;

enum ProjectStatusEnum
{
    public const PENDING = 'PENDING';
    public const IN_PROGRESS = 'IN_PROGRESS';
    public const COMPLETED = 'COMPLETED';
}
