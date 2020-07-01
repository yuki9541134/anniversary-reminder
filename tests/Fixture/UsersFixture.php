<?php
namespace App\Test\Fixture;

use App\Model\Entity\User;
use Cake\TestSuite\Fixture\TestFixture;

class UsersFixture extends TestFixture
{
    public $fields = [
        'id' => ['type' => 'integer'],
        'email' => ['type' => 'string', 'length' => 255, 'null' => false],
        'password' => ['type' => 'string'],
        'created' => 'datetime',
        'modified' => 'datetime',
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id']],
        ]
    ];

    public $records;

    public function init()
    {
        parent::init();

        // パスワードをハッシュ化するため、Userエンティティからレコードを作成する
        $user = new User([
           'email' => 'test1@example.com',
           'password' => 'password',
        ]);
        $this->records = [
            [
                'id' => 1,
                'email' => $user->email,
                'password' => $user->password,
                'created' => '2007-03-18 10:39:23',
                'modified' => '2007-03-18 10:41:31'
            ],
        ];
    }
}
