<?php

namespace Santi\Shared\Domain\Enum;

use Santi\Shared\Domain\Exception\InvalidEnumException;

class EventSourceEnum extends BaseEnum
{
    public const CRONJOB = 'CRONJOB';
    public const OTHER = 'OTHER';

    public static function fromValue(mixed $value): BaseEnum
    {
        $enum = new self();

        if (self::isValidValue($value)) {
            $enum->value = (string)$value;
        } else {
            throw new InvalidEnumException(static::class . ' - ' . self::class, (string)$value);
        }

        return $enum;
    }
}
