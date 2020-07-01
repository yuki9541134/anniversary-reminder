<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class PreciousUsersFixture extends TestFixture
{
    public $fields = [
        'id' => ['type' => 'integer'],
        'user_id' => ['type' => 'integer'],
        'name' => ['type' => 'string', 'length' => 255, 'null' => false],
        'gender' => ['type' => 'integer'],
        'relation' => ['type' => 'integer'],
        'created' => 'datetime',
        'modified' => 'datetime',
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id']],
        ]
    ];

    public $records = [
        [
            'id' => '1',
            'user_id' => '1',
            'name' => 'First Person',
            'gender' => '0',
            'relation' => '0',
            'created' => '2007-03-18 10:39:23',
            'modified' => '2007-03-18 10:41:31'
        ],
        [
            'id' => '2',
            'user_id' => '1',
            'name' => 'Second Person',
            'gender' => '1',
            'relation' => '1',
            'created' => '2007-03-18 10:41:23',
            'modified' => '2007-03-18 10:43:31'
        ],
        [
            'id' => '3',
            'user_id' => '2',
            'name' => 'Third Person',
            'gender' => '2',
            'relation' => '2',
            'created' => '2007-03-18 10:43:23',
            'modified' => '2007-03-18 10:45:31'
        ]
    ];
}
