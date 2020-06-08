<?php
namespace App\Model\Entity;

require dirname(__FILE__) .'/../../Lib/Enum.php';

use Cake\ORM\Entity;
use Lib\Enum\Gender;
use Lib\Enum\Relation;

class PreciousUser extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];

    public function getGender() {
        return new Gender($this->gender);
    }

    public function getRelation() {
        return new Relation($this->relation);
    }
}
