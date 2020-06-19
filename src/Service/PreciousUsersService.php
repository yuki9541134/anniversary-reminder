<?php
namespace App\Service;

use App\Model\Entity\PreciousUser;
use App\Model\Table\PreciousUsersTable;
use Cake\Database\Statement\CallbackStatement;
use Cake\Database\StatementInterface;
use Cake\Datasource\EntityInterface;
use Cake\ORM\TableRegistry;
use Cake\ORM\Query;

/**
 * @property PreciousUsersTable $PreciousUsers
 */
class PreciousUsersService extends AppService
{
    private $PreciousUsers;

    public function __construct()
    {
        parent::__construct();
        $this->PreciousUsers = TableRegistry::get('PreciousUsers');
    }

    /**
     * 大切な人一覧を取得する
     * @return Query
     */
    public function getPreciousUsers()
    {
        return $this->PreciousUsers->findPreciousUsers();
    }

    /**
     * 大切な人を取得する
     * @param int $id
     * @return PreciousUser|null
     */
    public function getPreciousUser(int $id)
    {
        return $this->PreciousUsers->getPreciousUser($id);
    }

    /**
     * 大切な人を登録する
     * @param PreciousUser $precious_user
     * @return PreciousUser|boolean
     */
    public function addPreciousUser(PreciousUser $precious_user)
    {
        return $this->PreciousUsers->addPreciousUser($precious_user);
    }

    /**
     * 大切な人を更新する
     * @param int $target_precious_user_id
     * @param PreciousUser $precious_user
     * @return boolean
     */
    public function updatePreciousUser(int $target_precious_user_id, PreciousUser $precious_user)
    {
        if ($this->getPreciousUser($target_precious_user_id) != null){
            $this->PreciousUsers->updatePreciousUser($target_precious_user_id, $precious_user);
            return true;
        }
        return false;
    }

    /**
     * 大切な人を削除する
     * @param int $target_precious_user_id
     * @return boolean
     */
    public function deletePreciousUser(int $target_precious_user_id)
    {
        $target_precious_user = $this->getPreciousUser($target_precious_user_id);
        if ($target_precious_user != null){
            $this->PreciousUsers->deletePreciousUser($target_precious_user);
            return true;
        }
        return false;
    }
} 
