<?php
namespace App\Enum;

/**
 * Enumの基底クラス
 */
abstract class AppEnum {
    private $value;
    const ENUM = [];

    public function __construct($key)
    {
        if (!static::isValidValue($key)) {
            throw new \InvalidArgumentException;
        }

        $this->value = static::ENUM[$key];
    }

    public static function isValidValue($key)
    {
        return array_key_exists($key, static::ENUM);
    }

    public function __toString() {
        return (string)$this->value;
    }

    public static function __callStatic($method, array $args)
    {
        return new self($method);
    }

    public function __set($key, $value)
    {
        throw new \BadMethodCallException('All setter is forbbiden');
    }
}

