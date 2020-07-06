<?php
namespace App\Controller;

use App\Service\PreciousUsersService;
use App\Model\Table\PreciousUsersTable;
use Cake\Http\Response;
use App\Database\Type\GenderEnumType;
use App\Database\Type\RelationEnumType;

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
        $precious_users = $this->Paginator->paginate($this->PreciousUsersService->getPreciousUsers($this->Auth->user('id')));
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
        $this->set('gender_selector', GenderEnumType::ENUM);
        $this->set('relation_selector', RelationEnumType::ENUM);
    }

    /**
     * 大切な人を追加する
     * @return Response|null
     */
    public function add()
    {
        $precious_user = $this->PreciousUsers->newEntity($this->request->getData());
        $precious_user->user_id = $this->Auth->user('id');
        if ($this->PreciousUsersService->addPreciousUser($precious_user)) {
            $this->Flash->success(__('大切な人を追加しました。'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('大切な人の追加に失敗しました。'));
        return $this->redirect(['action' => 'new']);
    }

    /**
     * 大切な人編集画面を表示する
     * @param int $id
     * @return Response|null
     */
    public function edit(int $id)
    {
        $user_id = $this->Auth->user('id');
        $precious_user = $this->PreciousUsersService->getPreciousUser($id, $user_id);
        if ($precious_user == null) {
            $this->Flash->error(__('対象が存在しないか、権限がありません。'));
            return $this->redirect(['action' => 'index']);
        }
        $this->set('id', $id);
        $this->set('precious_user', $precious_user);
        $this->set('gender_selector', array_values(GenderEnumType::ENUM));
        $this->set('relation_selector', array_values(RelationEnumType::ENUM));
    }

    /**
     * 大切な人を更新する
     * @return Response|null
     */
    public function update()
    {
        $target_precious_user_id = $this->request->getData('id');
        $user_id = $this->Auth->user('id');
        $precious_user = $this->PreciousUsers->newEntity($this->request->getData());

        if ($this->PreciousUsersService->updatePreciousUser($target_precious_user_id, $user_id, $precious_user)) {
            $this->Flash->success(__('大切な人を更新しました。'));
            return $this->redirect(['action' => 'index']);
        }

        $this->Flash->error(__('対象が存在しないか、権限がありません。'));
        return $this->redirect(['action' => 'index']);
    }

    /**
     * 大切な人を削除する
     * @param int $id
     * @return Response
     */
    public function delete(int $id)
    {
        $user_id = $this->Auth->user('id');

        if ($this->PreciousUsersService->deletePreciousUser($id, $user_id)) {
            $this->Flash->success(__('大切な人を削除しました。'));
        } else {
            $this->Flash->error(__('対象が存在しないか、権限がありません。'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
