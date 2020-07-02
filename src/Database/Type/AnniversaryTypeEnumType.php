<?php
namespace App\Database\Type;

class AnniversaryTypeEnumType extends EnumType
{
    const ENUM = [
        0 => "誕生日",
        1 => "記念日",
        2 => "父の日",
        3 => "母の日",
        4 => "その他",
    ];
}
