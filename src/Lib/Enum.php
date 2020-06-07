<?php
namespace Enum; 

abstract class Enum {
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

    public function __callStatic($method, array $args)
    {
        return new self($method);
    }

    public function __set($key, $value)
    {
        throw new \BadMethodCallException('All setter is forbbiden');
    }
}

final class Gender extends Enum {
    const ENUM = [
        0 => "男性",
        1 => "女性",
        2 => "その他",
    ];
}

final class Relation extends Enum {
    const ENUM = [
        0 => "父親",
        1 => "母親",
    ];
}
