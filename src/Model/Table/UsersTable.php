<?php
namespace App\Model\Table;

use App\Model\Entity\User;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{
    public function initialize(array $config)
    {

        parent::initialize($config);

        $this->addBehavior('Timestamp');

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('PreciousUsers', [
            'foreignKey' => 'user_id',
        ]);
    }

    /**
     * ユーザーのバリデーション
     * @param Validator $validator
     * @return Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->requirePresence('password', 'create')
            ->notEmpty('password');

        return $validator;
    }

    /**
     * ユーザーのルールチェッカー
     * @param RulesChecker $rules
     * @return RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['email']));
        return $rules;
    }

    /**
     * ユーザーを登録する
     * @param User $user
     * @return User|boolean
     */
    public function addUser(User $user)
    {
        return $this->save($user);
    }
}
