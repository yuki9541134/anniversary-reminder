<?php
namespace App\Controller;

require dirname(__FILE__) .'/../Lib/Enum.php';
use Enum\Gender;
use Enum\Relation;

class PreciousUsersController extends AppController
{
    public function index()
    {
        $this->loadComponent('Paginator');
        $precious_users = $this->Paginator->paginate($this->PreciousUsers->find());
        foreach ($precious_users as $precious_user) {
            $precious_user->gender = new Gender($precious_user->gender);
            $precious_user->relation = new Relation($precious_user->relation);
        }
        $this->set(compact('precious_users'));
    }
}
