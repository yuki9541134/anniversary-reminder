<?php
namespace App\Model\Table;

use App\Model\Entity\PreciousUser;
use Cake\Database\Statement\CallbackStatement;
use Cake\Database\StatementInterface;
use Cake\Datasource\EntityInterface;
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
     * 大切な人を取得する
     * @param int $id
     * @return array|EntityInterface
     */
    public function getPreciousUser($id)
    {
        return $this->get($id);
    }

    /**
     * 大切な人を登録する
     * @param PreciousUser $precious_user
     * @return PreciousUser|boolean
     */
    public function addPreciousUser(PreciousUser $precious_user)
    {
        return $this->save($precious_user);
    }

    /**
     * 大切な人を更新する
     * @param int $id
     * @param PreciousUser $precious_user
     * @return CallbackStatement|StatementInterface
     */
    public function updatePreciousUser($id, PreciousUser $precious_user)
    {
        return $this->query()
            ->update()
            ->set([
                'name' => $precious_user->name,
                'relation' => $precious_user->relation,
                'gender' => $precious_user->gender,
            ])
            ->where(['id' => $id])
            ->execute();
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
