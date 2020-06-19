<?php
namespace App\Model\Table;

use App\Model\Entity\PreciousUser;
use Cake\Database\Statement\CallbackStatement;
use Cake\Database\StatementInterface;
use Cake\Datasource\EntityInterface;
use Cake\Datasource\Exception\RecordNotFoundException;
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
     * @return PreciousUser|null
     */
    public function getPreciousUser($id)
    {
        try {
            return $this->get($id);
        } catch (RecordNotFoundException $e) {
            return null;
        }
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
     * @param int $target_precious_user_id
     * @param PreciousUser $precious_user
     * @return int
     */
    public function updatePreciousUser(int $target_precious_user_id, PreciousUser $precious_user)
    {
        return $this->query()
            ->update()
            ->set([
                'name' => $precious_user->name,
                'relation' => $precious_user->relation,
                'gender' => $precious_user->gender,
            ])
            ->where(['id' => $target_precious_user_id])
            ->execute()
            ->rowCount();
    }

    /**
     * 大切な人を削除する
     * @param PreciousUser $precious_user
     * @return boolean
     */
    public function deletePreciousUser(PreciousUser $precious_user)
    {
        return $this->delete($precious_user);
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
