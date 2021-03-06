<?php
namespace App\Database\Type;

use Cake\Database\Driver;
use Cake\Database\Type;
use PDO;

class EnumType extends Type
{
    const ENUM = [];

    public function toPHP($value, Driver $driver)
    {
        if ($value === null) {
            return null;
        }
        return static::ENUM[$value];
    }

    public function marshal($value)
    {
        if (is_array($value) || $value === null) {
            return $value;
        }
        return static::ENUM[$value];
    }

    public function toDatabase($value, Driver $driver)
    {
        foreach (array_keys(static::ENUM) as $key) {
            if (static::ENUM[$key] === $value) {
                return $key;
            }
        }
    }

    public function toStatement($value, Driver $driver)
    {
        if ($value === null) {
            return PDO::PARAM_NULL;
        }
        return PDO::PARAM_STR;
    }
}
