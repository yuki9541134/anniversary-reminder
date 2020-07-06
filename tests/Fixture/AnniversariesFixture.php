<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class AnniversariesFixture extends TestFixture
{
    public $fields = [
        'id' => ['type' => 'integer'],
        'user_id' => ['type' => 'integer'],
        'precious_user_id' => ['type' => 'integer'],
        'anniversary_type' => ['type' => 'integer'],
        'anniversary_date' => 'datetime',
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
            'precious_user_id' => '1',
            'anniversary_type' => '0',
            'anniversary_date' => '2020-07-10 00:00:00',
            'created' => '2007-03-18 10:39:23',
            'modified' => '2007-03-18 10:41:31'
        ],
        [
            'id' => '2',
            'user_id' => '2',
            'precious_user_id' => '2',
            'anniversary_type' => '1',
            'anniversary_date' => '2020-07-11 00:00:00',
            'created' => '2007-03-18 10:39:23',
            'modified' => '2007-03-18 10:41:31'
        ],
    ];
}
