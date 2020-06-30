<?php
namespace App\Controller;

use App\Model\Table\AnniversariesTable;
use App\Service\AnniversariesService;
use Cake\Http\Response;

/**
 * @property AnniversariesService $AnniversariesService
 * @property AnniversariesTable $Anniversaries
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
    }

    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');
        // ログインしているユーザーに許可する
        if (in_array($action, ['index'])) {
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
}
