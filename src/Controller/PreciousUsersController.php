<?php
namespace App\Controller;

class PreciousUsersController extends AppController
{
    public function index()
    {
        $this->loadComponent('Paginator');
        $precious_users = $this->Paginator->paginate($this->PreciousUsers->find());
        $this->set(compact('precious_users'));
    }
}
