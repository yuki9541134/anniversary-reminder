<?php
namespace App\Model\Entity;

//require dirname(__FILE__) . '/../../Enum/AppEnum.php';

use Cake\ORM\Entity;
use App\Enum\Gender;
use App\Enum\Relation;

/**
 * 大切な人エンティティ
 *
 * @property int $id ID
 * @property int $user_id ユーザーID
 * @property string $name 名前
 * @property int $gender 性別
 * @property int $relation 関係
 * @property Time|FrozenTime $created 作成日時
 * @property Time|FrozenTime|null $modified 最終更新日時
 */
class PreciousUser extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];

    public function getGender() {
        return new Gender($this->gender);
    }

    public function getRelation() {
        return new Relation($this->relation);
    }
}
