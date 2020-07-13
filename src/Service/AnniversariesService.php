<?php
namespace App\Service;

use App\Model\Entity\Anniversary;
use App\Model\Table\AnniversariesTable;
use Cake\ORM\Query;

/**
 * @property AnniversariesTable $Anniversaries
 */
class AnniversariesService extends AppService
{
    private $Anniversaries;

    /**
     * コンストラクタ
     * serviceとtableが密結合だとモックが作れないので、疎結合にする。
     * @param AnniversariesTable $Anniversaries
     */
    public function __construct(AnniversariesTable $Anniversaries)
    {
        parent::__construct();
        $this->Anniversaries = $Anniversaries;
    }

    /**
     * ユーザーIDに紐づく記念日一覧を取得するクエリを発行
     * @param int $user_id
     * @return Query
     */
    public function findAnniversaries(int $user_id): Query
    {
        return $this->Anniversaries->findAnniversaries($user_id);
    }

    /**
     * 記念日を登録する
     * @param Anniversary $anniversary
     * @return Anniversary|bool
     */
    public function addAnniversary(Anniversary $anniversary)
    {
        return $this->Anniversaries->addAnniversary($anniversary);
    }
} 
