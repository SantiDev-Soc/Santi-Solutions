<?php
declare(strict_types=1);

namespace Santi\Leads\Domain\Enum;

use Santi\Shared\Domain\Enum\BaseEnum;
use Santi\Shared\Domain\Exception\InvalidEnumException;

class LeadStatusEnum extends BaseEnum
{
    public const string PENDING_REVIEW = 'PENDING_REVIEW';
    public const string CONTACTED = 'CONTACTED';
    public const string NEW = 'NEW';
    public const string QUALIFIED = 'QUALIFIED';
    public const string CONVERTED = 'CONVERTED';
    public const string LOST = 'LOST';


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

    public static function new(): self
    {
      return self::fromValue(self::NEW);
    }
}
