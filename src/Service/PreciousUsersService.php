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

    public function getPreciousUsers()
    {
        return $this->PreciousUsers->findPreciousUsers();
    }
} 
