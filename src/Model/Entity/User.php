<?php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * ユーザーエンティティ
 *
 * @property int $id ID
 * @property string $email 名前
 * @property string $password 性別
 * @property Time|FrozenTime $created 作成日時
 * @property Time|FrozenTime|null $modified 最終更新日時
 *
 * @property PreciousUser $precious_user
 */
class User extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];

    protected $_hidden = [
        'password',
    ];

    /**
     * パスワードをハッシュ化してセットする
     * @param String $value
     * @return bool|string
     */
    protected function _setPassword($value)
    {
        if (strlen($value)) {
            $hasher = new DefaultPasswordHasher();

            return $hasher->hash($value);
        }
    }
}
