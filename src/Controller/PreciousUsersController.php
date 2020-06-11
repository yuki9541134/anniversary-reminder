<?php
namespace App\Controller;

use App\Service\PreciousUsersService;

use Lib\Enum\Gender;
use Lib\Enum\Relation;

/**
 * @property PreciousUsersService $PreciousUsersService
 */
class PreciousUsersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
        $this->loadComponent('Flash');
    }

    public function index()
    {
        $this->PreciousUsersService = new PreciousUsersService();
        $precious_users = $this->Paginator->paginate($this->PreciousUsersService->getPreciousUsers());
        $this->set(compact('precious_users'));
    }

    public function add()
    {
        $precious_user = $this->PreciousUsers->newEntity();
        if ($this->request->is('post')) {
            $precious_user = $this->PreciousUsers->patchEntity($precious_user, $this->request->getData());

            if ($this->PreciousUsers->save($precious_user)) {
                $this->Flash->success(__('大切な人を追加しました。'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('大切な人の追加に失敗しました。'));
        }
        $this->set('precious_user', $precious_user);
        $this->set('gender_selector', Gender::ENUM);
        $this->set('relation_selector', Relation::ENUM);
    }
}
