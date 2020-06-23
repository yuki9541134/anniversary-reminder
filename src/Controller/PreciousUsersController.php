<?php
namespace App\Controller;

use App\Service\PreciousUsersService;
use App\Model\Table\PreciousUsersTable;
use Cake\Http\Response;
use App\Enum\Gender;
use App\Enum\Relation;

/**
 * @property PreciousUsersService $PreciousUsersService
 * @property PreciousUsersTable $PreciousUsers
 */
class PreciousUsersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
        $this->loadComponent('Flash');
        // serviceにtableを注入する
        $this->PreciousUsersService = new PreciousUsersService($this->PreciousUsers);
    }

    /**
     * 大切な人一覧画面を表示する
     * @return void
     */
    public function index()
    {
        $precious_users = $this->Paginator->paginate($this->PreciousUsersService->getPreciousUsers());
        $this->set(compact('precious_users'));
    }

    /**
     * 大切な人追加画面を表示する
     * @return void
     */
    public function new()
    {
        $precious_user = $this->PreciousUsers->newEntity();
        $this->set('precious_user', $precious_user);
        $this->set('gender_selector', Gender::ENUM);
        $this->set('relation_selector', Relation::ENUM);
    }

    /**
     * 大切な人を追加する
     * @return Response|null
     */
    public function add()
    {
        $precious_user = $this->PreciousUsers->newEntity($this->request->getData());
        if ($this->PreciousUsersService->addPreciousUser($precious_user)) {
            $this->Flash->success(__('大切な人を追加しました。'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('大切な人の追加に失敗しました。'));
        return $this->redirect(['action' => 'new']);
    }

    /**
     * 大切な人編集画面を表示する
     * @param $id
     * @return Response|null
     */
    public function edit($id)
    {
        $precious_user = $this->PreciousUsersService->getPreciousUser($id);
        if ($precious_user == null) {
            return $this->redirect(['action' => 'index']);
        }
        $this->set('id', $id);
        $this->set('precious_user', $precious_user);
        $this->set('gender_selector', Gender::ENUM);
        $this->set('relation_selector', Relation::ENUM);
    }

    /**
     * 大切な人を更新する
     * @return Response|null
     */
    public function update()
    {
        $precious_user = $this->PreciousUsers->newEntity($this->request->getData());
        $target_precious_user_id = $this->request->getData('id');
        if ($this->PreciousUsersService->updatePreciousUser($target_precious_user_id, $precious_user)) {
            $this->Flash->success(__('大切な人を更新しました。'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('大切な人の更新に失敗しました。'));
        return $this->redirect(['action' => 'edit', $target_precious_user_id]);
    }

    /**
     * 大切な人を削除する
     * @return Response
     */
    public function delete($id)
    {
        if ($this->PreciousUsersService->deletePreciousUser($id)) {
            $this->Flash->success(__('大切な人を削除しました。'));
        } else {
            $this->Flash->error(__('大切な人の削除に失敗しました。'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
