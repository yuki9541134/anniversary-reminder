<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PreciousUsersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Cake\I18n\FrozenTime;

class PreciousUsersTableTest extends TestCase
{
    public $fixtures = ['app.PreciousUsers'];

    public function setUp()
    {
        parent::setUp();
        $this->PreciousUsers = TableRegistry::getTableLocator()->get('PreciousUsers');
    }

    public function testFind()
    {
        $query = $this->PreciousUsers->find();
        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->enableHydration(false)->toArray();
        $expected = [
            ['id' => 1, 'user_id' => 0, 'name' => 'First Person', 'gender' => 0, 'relation' => 0, 'created' => new FrozenTime('2007-03-18 10:39:23'), 'modified' => new FrozenTime('2007-03-18 10:41:31')],
            ['id' => 2, 'user_id' => 1, 'name' => 'Second Person', 'gender' => 1, 'relation' => 1, 'created' => new FrozenTime('2007-03-18 10:41:23'), 'modified' => new FrozenTime('2007-03-18 10:43:31')],
            ['id' => 3, 'user_id' => 2, 'name' => 'Third Person', 'gender' => 2, 'relation' => 2, 'created' => new FrozenTime('2007-03-18 10:43:23'), 'modified' => new FrozenTime('2007-03-18 10:45:31')],
        ];

        $this->assertEquals($expected, $result);
    }
}
