<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class PreciousUsersTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
    }

    public function findPreciousUsers()
    {
        $query = $this->find();
        return $query;
    }
}
