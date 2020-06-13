<?php
namespace App\Service;

use App\Model\Table\PreciousUsersTable;
use Cake\ORM\TableRegistry;

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
     * @param $precious_user
     * @return boolean
     */
    public function addPreciousUser($precious_user)
    {
        return $this->PreciousUsers->addPreciousUser($precious_user);
    }
} 
