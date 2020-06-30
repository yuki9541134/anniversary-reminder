<?php
namespace App\Model\Table;

use App\Model\Entity\Anniversary;
use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class AnniversariesTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
    }
}
