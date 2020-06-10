<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class PreciousUsersTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
    }

    /**
     * 大切な人一覧を取得するクエリを取得
     * @return \Cake\ORM\Query
     */
    public function findPreciousUsers()
    {
        return $this->find();
    }
}
