<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Entity\PreciousUser;
use App\Model\Table\PreciousUsersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Cake\I18n\FrozenTime;

/**
 * @property PreciousUsersTable $PreciousUsers
 */
class PreciousUsersTableTest extends TestCase
{
    public $fixtures = ['app.PreciousUsers'];
    private $PreciousUsers;

    /**
     * setUp method
     * @return void
     * テスト前に毎回実行される
     */
    public function setUp()
    {
        parent::setUp();
        $this->PreciousUsers = TableRegistry::getTableLocator()->get('PreciousUsers');
    }

    /**
     * 正常系
     * @return void
     */
    public function testFind()
    {
        $query = $this->PreciousUsers->findPreciousUsers();
        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->enableHydration(false)->toArray();
        $expected = [
            ['id' => 1, 'user_id' => 0, 'name' => 'First Person', 'gender' => 0, 'relation' => 0, 'created' => new FrozenTime('2007-03-18 10:39:23'), 'modified' => new FrozenTime('2007-03-18 10:41:31')],
            ['id' => 2, 'user_id' => 1, 'name' => 'Second Person', 'gender' => 1, 'relation' => 1, 'created' => new FrozenTime('2007-03-18 10:41:23'), 'modified' => new FrozenTime('2007-03-18 10:43:31')],
            ['id' => 3, 'user_id' => 2, 'name' => 'Third Person', 'gender' => 2, 'relation' => 2, 'created' => new FrozenTime('2007-03-18 10:43:23'), 'modified' => new FrozenTime('2007-03-18 10:45:31')],
        ];

        $this->assertEquals($expected, $result);
    }

    /**
     * 正常系
     * @return void
     */
    public function testGetPreciousUserSuccess()
    {
        $result = $this->PreciousUsers->getPreciousUser(1);
        $this->assertInstanceOf('App\Model\Entity\PreciousUser', $result);
        $expected = ['id' => 1, 'user_id' => 0, 'name' => 'First Person', 'gender' => 0, 'relation' => 0, 'created' => new FrozenTime('2007-03-18 10:39:23'), 'modified' => new FrozenTime('2007-03-18 10:41:31')];
        $this->assertEquals($expected, $result->toArray());
    }

    /**
     * 異常系 見つからない時
     * @return void
     */
    public function testGetPreciousUserFailed()
    {
        $result = $this->PreciousUsers->getPreciousUser(100);
        $this->assertEquals(false, $result);
    }

    /**
     * 正常系
     * @return void
     */
    public function testAddPreciousUserSuccess()
    {
        $precious_user = $this->PreciousUsers->newEntity([
            'user_id' => 1,
            'name' => 'aaa',
            'gender' => 0,
            'relation' => 0,
        ]);
        $result = $this->PreciousUsers->addPreciousUser($precious_user);
        $this->assertInstanceOf('Cake\ORM\Entity', $result);
        $this->assertEquals('aaa', $result->name);
    }

    /**
     * 異常系 nameが空の時
     * @return void
     */
    public function testAddPreciousUserFailed()
    {
        $precious_user = $this->PreciousUsers->newEntity([
            'user_id' => 1,
            'name' => '',
            'gender' => 0,
            'relation' => 0,
        ]);
        $result = $this->PreciousUsers->addPreciousUser($precious_user);
        $this->assertEquals(false, $result);
    }

    /**
     * 正常系
     * @return void
     */
    public function testUpdatePreciousUserSuccess()
    {
        $precious_user = $this->PreciousUsers->newEntity([
            'user_id' => 1,
            'name' => 'aaa',
            'gender' => 0,
            'relation' => 0,
        ]);
        $result = $this->PreciousUsers->updatePreciousUser(1, $precious_user);
        $this->assertEquals(1, $result);
    }

    /**
     * 準正常系 更新対象が0件
     * @return void
     */
    public function testUpdatePreciousUserNotFound()
    {
        $precious_user = $this->PreciousUsers->newEntity([
            'user_id' => 1,
            'name' => 'aaa',
            'gender' => 0,
            'relation' => 0,
        ]);
        $result = $this->PreciousUsers->updatePreciousUser(100, $precious_user);
        $this->assertEquals(0, $result);
    }
    
    /**
    * Validation 正常系
    * @return void
    */
    public function testValidationDefaultSuccess()
    {
        $data = [
            'user_id' => 1,
            'name' => 'aaa',
            'gender' => 0,
            'relation' => 0,
        ];
        $precious_user = $this->PreciousUsers->newEntity($data);
        $this->assertEmpty($precious_user->getErrors());
    }
    
    /**
     * Validation 異常系 nameが空のとき
     * @return void
     */
    public function testValidationDefaultFailedWithEmptyName()
    {
        $data = [
            'user_id' => 1,
            'name' => '',
            'gender' => 0,
            'relation' => 0,
        ];
        $precious_user = $this->PreciousUsers->newEntity($data);
        $this->assertNotEmpty($precious_user->getErrors());
    }
    
    /**
     * Validation 異常系 nameが256文字以上
     * @return void
     */
    public function testValidationDefaultFailedWithTooLongName()
    {
        $data = [
            'user_id' => 1,
            'name' => str_repeat("a", 1000),
            'gender' => 0,
            'relation' => 0,
        ];
        $precious_user = $this->PreciousUsers->newEntity($data);
        $this->assertNotEmpty($precious_user->getErrors());
    }
}
