<?php
namespace App\Database\Type;

class GenderEnumType extends EnumType
{
    const ENUM = [
        0 => "男性",
        1 => "女性",
        2 => "その他",
    ];
}
