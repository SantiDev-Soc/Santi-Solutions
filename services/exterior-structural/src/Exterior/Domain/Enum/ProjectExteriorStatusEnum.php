<?php
declare(strict_types = 1);

namespace Santi\Exterior\Domain\Enum;

use Santi\Shared\Domain\Enum\BaseEnum;
use Santi\Shared\Domain\Exception\InvalidEnumException;

class ProjectExteriorStatusEnum extends BaseEnum
{
    public const PENDING_REVIEW = 'PENDING_REVIEW';
    public const CREATED = 'CREATED';
    public const COMPLETED = 'COMPLETED';
    public const REJECTED = 'REJECTED';
    public const CANCELLED = 'CANCELLED';
    private static $fromValue;

    public static function fromValue(mixed $value): self
    {
        $enum = new self();
        if (self::isValidValue($value)) {
            $enum->value = (string)$value;
        } else {
            throw new InvalidEnumException(static::class . ' - ' . self::class, (string)$value);
        }
        return $enum;
    }

    public static function pendingReview(): self
    {
        return self::fromValue(self::PENDING_REVIEW);
    }

    public function equals(self $other): bool
    {
        return $this->value === $other->value;
    }
}
