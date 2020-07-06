<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * 記念日エンティティ
 *
 * @property int $id ID
 * @property int $user_id ユーザーID
 * @property int $precious_user_id 大切な人ID
 * @property int $anniversary_type 記念日の種類
 * @property Time|FrozenTime $anniversary_date 記念日の日付
 * @property Time|FrozenTime $created 作成日時
 * @property Time|FrozenTime|null $modified 最終更新日時
 */
class Anniversary extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
