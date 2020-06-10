<?php
namespace App\Controller;

use App\Service\PreciousUsersService;

/**
 * @property PreciousUsersService $PreciousUsersService
 */
class PreciousUsersController extends AppController
{
    public function index()
    {
        $this->PreciousUsersService = new PreciousUsersService();
        $this->loadComponent('Paginator');
        $precious_users = $this->Paginator->paginate($this->PreciousUsersService->getPreciousUsers());
        $this->set(compact('precious_users'));
    }
}
