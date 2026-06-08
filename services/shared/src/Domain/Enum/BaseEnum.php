<?php
declare(strict_types=1);

namespace Santi\Shared\Domain\Enum;

use ReflectionException;
use Santi\Shared\Domain\Exception\InvalidEnumException;

class BaseEnum implements \JsonSerializable
{
    private static array $constCache = [];

    protected string $value;

    public function getValue(): string
    {
        return $this->value;
    }

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

    public static function isValidValue(mixed $value, bool $strict = true): bool
    {
        try {
            return in_array($value, array_values(self::obtainConstants()), $strict);
        } catch (ReflectionException $e) {
            return false;
        }
    }

    public static function obtainConstants(): mixed
    {
        $calledClass = static::class;
        if (false === array_key_exists($calledClass, self::$constCache)) {
            self::$constCache[$calledClass] = new \ReflectionClass($calledClass)->getConstants();
        }
        return self::$constCache[$calledClass];
    }

    public static function fromName(string $name): self
    {
        $enum = new self();
        if (self::isValidName($name)) {
            $constants = self::obtainConstants();
            $enum->value = $constants[$name];
        } else {
            throw new InvalidEnumException(self::class, $name);
        }
        return $enum;
    }

    public static function isValidName(string $name, bool $strict = false): bool
    {
        $constants = self::obtainConstants();

        if ($strict) {
            return array_key_exists($name, $constants);
        }

        $keys = array_map(static function ($item) {
            if (is_string($item)) {
                return mb_strtolower($item);
            }
            return $item;
        }, array_keys($constants));

        return in_array(strtolower($name), $keys, false);
    }

    /**
     * @throws ReflectionException
     */
    public static function __callStatic(string $name, array $arguments): self
    {
        if (method_exists(static::class, $name)) {
            return self::$name($arguments);
        }
        $constantName = strtoupper(u($name)->snake()->toString());
        return static::fromName($constantName);
    }

    public function jsonSerialize(): string
    {
        return $this->value;
    }
}
