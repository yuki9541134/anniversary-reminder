<?php
namespace App\Service;

use Cake\ORM\TableRegistry;
use Cake\ORM\Query;

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
     * @param array $precious_user
     * @return boolean
     */
    public function addPreciousUser(array $precious_user)
    {
        return $this->PreciousUsers->addPreciousUser($precious_user);
    }
} 
