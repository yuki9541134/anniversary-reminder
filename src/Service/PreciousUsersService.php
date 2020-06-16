<?php
namespace App\Service;

use App\Model\Entity\PreciousUser;
use App\Model\Table\PreciousUsersTable;
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
     * 大切な人を登録する
     * @param PreciousUser $precious_user
     * @return PreciousUser|boolean
     */
    public function addPreciousUser(PreciousUser $precious_user)
    {
        return $this->PreciousUsers->addPreciousUser($precious_user);
    }
} 
