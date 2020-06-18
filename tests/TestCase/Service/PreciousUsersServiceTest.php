<?php
namespace App\Test\TestCase\Service;
;

use App\Model\Entity\PreciousUser;
use App\Service\PreciousUsersService;
use Cake\TestSuite\TestCase;

/**
 * @property PreciousUsersService $PreciousUsersService
 */
class PreciousUsersServiceTest extends TestCase
{
    private $PreciousUsersService;
    public $fixtures = ['app.PreciousUsers'];

    /**
     * setUp method
     * @return void
     * テスト前に毎回実行される
     */
    public function setUp()
    { 
        parent::setUp();
        $this->PreciousUsersService = new PreciousUsersService;
    }

    /**
     * 正常系
     * @return void
     */
    public function testGetPreciousUsers()
    {     
        $query = $this->PreciousUsersService->getPreciousUsers(); 
        $this->assertInstanceOf('Cake\ORM\Query', $query);
    }

    /**
     * 正常系
     * @return void
     */
    public function testGetPreciousUser()
    {
        $result = $this->PreciousUsersService->getPreciousUser(1);
        $this->assertInstanceOf('App\Model\Entity\PreciousUser', $result);
    }

    /**
     * 正常系
     * @return void
     */
    public function testAddPreciousUser()
    {
        $data = [
            'user_id' => 1,
            'name' => 'aaa',
            'gender' => 0,
            'relation' => 0,
        ];
        $precious_user = new PreciousUser($data);
        $result = $this->PreciousUsersService->addPreciousUser($precious_user);
        $this->assertInstanceOf('Cake\ORM\Entity', $result);
    }

    /**
     * 正常系
     * @return void
     */
    public function testUpdatePreciousUser()
    {
        $data = [
            'user_id' => 1,
            'name' => 'aaa',
            'gender' => 0,
            'relation' => 0,
        ];
        $precious_user = new PreciousUser($data);
        $result = $this->PreciousUsersService->updatePreciousUser(1, $precious_user);
        $this->assertEquals(1, $result);
    }
}
