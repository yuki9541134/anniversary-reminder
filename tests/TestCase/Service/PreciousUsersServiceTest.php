<?php
namespace App\Test\TestCase\Service;
;
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
    public function testAddPreciousUser()
    {
        $precious_user = [
            'user_id' => 1,
            'name' => 'aaa',
            'gender' => 0,
            'relation' => 0,
        ];
        $result = $this->PreciousUsersService->addPreciousUser($precious_user);
        $this->assertInstanceOf('Cake\ORM\Entity', $result);
    }
}
