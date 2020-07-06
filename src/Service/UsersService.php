<?php
namespace App\Service;

use App\Model\Entity\User;
use App\Model\Table\UsersTable;

/**
 * @property UsersTable $Users
 */
class UsersService extends AppService
{
    private $Users;

    /**
     * コンストラクタ
     * serviceとtableが密結合だとモックが作れないので、疎結合にする。
     * @param UsersTable $Users
     */
    public function __construct(UsersTable $Users)
    {
        parent::__construct();
        $this->Users = $Users;
    }

    /**
     * ユーザーを登録する
     * @param User $user
     * @return User|boolean
     */
    public function addUser(User $user)
    {
        return $this->Users->addUser($user);
    }
}
