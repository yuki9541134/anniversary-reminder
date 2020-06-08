<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class PreciousUsersFixture extends TestFixture
{
    public $import = ['table' => 'precious_users'];
    public $records = [
        [
            'user_id' => '0',
            'name' => 'First Person',
            'gender' => '0',
            'relation' => '0',
            'created' => '2007-03-18 10:39:23',
            'modified' => '2007-03-18 10:41:31'
        ],
        [
            'user_id' => '1',
            'name' => 'Second Person',
            'gender' => '1',
            'relation' => '1',
            'created' => '2007-03-18 10:41:23',
            'modified' => '2007-03-18 10:43:31'
        ],
        [
            'user_id' => '2',
            'name' => 'Third Person',
            'gender' => '2',
            'relation' => '2',
            'created' => '2007-03-18 10:43:23',
            'modified' => '2007-03-18 10:45:31'
        ]
    ];
}
