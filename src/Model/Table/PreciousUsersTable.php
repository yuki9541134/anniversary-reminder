<?php
namespace App\Model\Table;

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
     * @return \Cake\ORM\Query
     */
    public function findPreciousUsers()
    {
        return $this->find();
    }

    /**
     * 大切な人のバリデーション
     * @param Cake\Validation\Validator
     * @return Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->minLength('name', 1)
            ->maxLength('name', 255);

        return $validator;
    }
}
