<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class PreciousUser extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
