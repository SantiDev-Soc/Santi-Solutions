<?php
declare(strict_types=1);

namespace Santi\Shared\Domain\Exception;

class InvalidEnumException extends \DomainException
{
    public function __construct(string $enumClass, string $value)
    {
        parent::__construct($enumClass . ' got invalid value ' . $value);
    }
}

