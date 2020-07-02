<?php
namespace App\Model\Table;

use App\Model\Entity\Anniversary;
use Cake\Database\Schema\TableSchema;
use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class AnniversariesTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
        $this->belongsTo('Users');
        $this->belongsTo('PreciousUsers');
    }

    protected function _initializeSchema(TableSchema $schema)
    {
        $schema->setColumnType('anniversary_type', 'AnniversaryType');
        return $schema;
    }

    /**
     * ユーザーIDに紐づく記念日一覧を取得するクエリを発行
     * @param int $user_id
     * @return Query
     */
    public function findAnniversaries(int $user_id): Query
    {
        return $this->find()
            ->contain(['Users', 'PreciousUsers'])
            ->where(['Anniversaries.user_id' => $user_id]);
    }
}
