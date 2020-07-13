<?php
namespace App\Model\Table;

use App\Model\Entity\Anniversary;
use Cake\Database\Schema\TableSchema;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
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

    /**
     * 誕生日を登録する
     * @param Anniversary $anniversary
     * @return Anniversary|boolean
     */
    public function addAnniversary(Anniversary $anniversary)
    {
        return $this->save($anniversary);
    }

    /**
     * 記念日のバリデーション
     * @param Validator $validator
     * @return Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->integer('user_id')
            ->requirePresence('user_id', 'create')
            ->notEmpty('user_id');

        $validator
            ->integer('precious_user_id')
            ->requirePresence('precious_user_id', 'create')
            ->notEmpty('precious_user_id');

        $validator
            ->integer('anniversary_type')
            ->requirePresence('anniversary_type', 'create')
            ->notEmpty('anniversary_type');

        $validator
            ->dateTime('anniversary_date')
            ->requirePresence('anniversary_date', 'create')
            ->notEmpty('anniversary_date');

        return $validator;
    }

    /**
     * ユーザーのルールチェッカー
     * @param RulesChecker $rules
     * @return RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('user_id', 'Users'));
        $rules->add($rules->existsIn('precious_user_id', 'PreciousUsers'));
        return $rules;
    }
}
