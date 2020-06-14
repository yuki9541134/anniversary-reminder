<?php
namespace App\Model\Table;

use Cake\ORM\Entity;
use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class PreciousUsersTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
    }

    /**
     * 大切な人一覧を取得するクエリを取得
     * @return Query
     */
    public function findPreciousUsers()
    {
        return $this->find();
    }

    /**
     * 大切な人を登録する
     * @param array $precious_user
     * @return Entity|boolean
     */
    public function addPreciousUser(array $precious_user)
    {
        return $this->save($this->newEntity($precious_user));
    }

    /**
     * 大切な人のバリデーション
     * @param Validator $validator
     * @return Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->minLength('name', 1)
            ->maxLength('name', 255);

        return $validator;
    }
}
