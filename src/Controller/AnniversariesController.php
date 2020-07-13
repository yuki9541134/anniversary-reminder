<?php
namespace App\Controller;

use App\Database\Type\AnniversaryTypeEnumType;
use App\Model\Table\AnniversariesTable;
use App\Service\AnniversariesService;
use App\Service\PreciousUsersService;
use Cake\Http\Response;
use Cake\ORM\TableRegistry;

/**
 * @property AnniversariesService $AnniversariesService
 * @property AnniversariesTable $Anniversaries
 * @property PreciousUsersService $PreciousUsersService
 */
class AnniversariesController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
        $this->loadComponent('Flash');
        // serviceにtableを注入する
        $this->AnniversariesService = new AnniversariesService($this->Anniversaries);
        $this->PreciousUsersService = new PreciousUsersService(TableRegistry::get('PreciousUsers'));
    }

    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');
        // ログインしているユーザーに許可する
        if (in_array($action, ['index', 'new', 'add'])) {
            return true;
        }
    }

    /**
     * 記念日一覧画面を表示する
     * @return void
     */
    public function index()
    {
        $anniversaries = $this->Paginator->paginate($this->AnniversariesService->findAnniversaries($this->Auth->user('id')));
        $this->set(compact('anniversaries'));
    }

    /**
     * 記念日追加画面を表示する
     * @return void
     */
    public function new()
    {
        $anniversary = $this->Anniversaries->newEntity();
        $this->set('anniversary', $anniversary);

        $user_id = $this->Auth->user('id');
        $precious_users_selector = $this->PreciousUsersService->getPreciousUsers($user_id)
            ->find('list', [
                'keyField' => 'id',
                'valueFiled' => 'name'
            ]);
        $this->set('precious_user_selector', $precious_users_selector);

        $this->set('anniversary_type_selector', AnniversaryTypeEnumType::ENUM);
    }

    /**
     * 記念日を追加する
     * @return Response|null
     */
    public function add()
    {
        $request_body = $this->request->getData();
        $request_body['user_id'] = $this->Auth->user('id');

        $anniversary = $this->Anniversaries->newEntity($request_body);

        if ($this->AnniversariesService->addAnniversary($anniversary)) {
            $this->Flash->success(__('記念日を追加しました。'));
            return $this->redirect(['action' => 'index']);
        }

        $this->Flash->error(__('記念日の追加に失敗しました。'));
        return $this->redirect(['action' => 'new']);
    }
}
