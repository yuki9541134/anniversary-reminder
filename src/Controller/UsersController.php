<?php
namespace App\Controller;

use App\Model\Table\UsersTable;
use Cake\Http\Response;

/**
 * @property UsersTable $Users
 */
class UsersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Flash');
        $this->Auth->allow(['new', 'add', 'login']);
    }

    /**
     * ログイン画面を表示する
     * @return void
     */
    public function loginForm()
    {
    }

    /**
     * ログイン
     * @return Response|null
     */
    public function login()
    {
        $user = $this->Auth->identify();
        if ($user) {
            $this->Auth->setUser($user);
            $this->Flash->success('ログインしました。');
            return $this->redirect($this->Auth->redirectUrl(['controller' => 'PreciousUsers', 'action' => 'index']));
        }
        $this->Flash->error('ユーザー名またはパスワードが不正です。');
        return $this->redirect(['action' => 'loginForm']);
    }

    /**
     * ログアウト
     * @return Response|null
     */
    public function logout()
    {
        $this->Flash->success('ログアウトしました。');
        return $this->redirect($this->Auth->logout());
    }

    /**
     * ユーザー登録画面
     * @return void
     */
    public function new()
    {
        $user = $this->Users->newEntity();
        $this->set(compact('user'));
    }

    /**
     * ユーザー登録
     * @return Response|null
     */
    public function add()
    {
        $user = $this->Users->newEntity($this->request->getData());
        if ($this->Users->save($user)) {
            $this->Flash->success(__('ユーザー登録に成功しました。'));
            return $this->redirect(['action' => 'loginForm']);
        }
        $this->Flash->error(__('ユーザー登録に失敗しました。'));
        return $this->redirect(['action' => 'new']);
    }
}
