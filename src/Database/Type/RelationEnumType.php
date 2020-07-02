<?php
namespace App\Database\Type;

class RelationEnumType extends EnumType
{
    const ENUM = [
        0 => "父親",
        1 => "母親",
        2 => "彼女",
    ];
}
