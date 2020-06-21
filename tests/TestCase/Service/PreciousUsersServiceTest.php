<?php
namespace App\Test\TestCase\Service;

use App\Model\Entity\PreciousUser;
use App\Service\PreciousUsersService;
use Cake\TestSuite\TestCase;
use Mockery;

/**
 * @property PreciousUsersService $PreciousUsersService
 */
class PreciousUsersServiceTest extends TestCase
{
    private $PreciousUsersService;

    /**
     * setUp method
     * @return void
     * テスト前に毎回実行される
     */
    public function setUp()
    { 
        parent::setUp();
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
        // setup
        $id = 1;
        $precious_user = new PreciousUser();

        $PreciousUsers = Mockery::mock('PreciousUsers');
        $PreciousUsers->shouldReceive('getPreciousUser')
            ->with($id)
            ->once()
            ->andReturn($precious_user);
        $this->PreciousUsersService = new PreciousUsersService($PreciousUsers);

        // test
        $result = $this->PreciousUsersService->getPreciousUser($id);
        $this->assertEquals($precious_user, $result);
    }

    /**
     * 正常系
     * @return void
     */
    public function testAddPreciousUser()
    {
        // setup
        $precious_user = new PreciousUser([
            'user_id' => 1,
            'name' => 'aaa',
            'gender' => 0,
            'relation' => 0,
        ]);

        $PreciousUsers = Mockery::mock('PreciousUsers');
        $PreciousUsers->shouldReceive('addPreciousUser')
            ->with($precious_user)
            ->once()
            ->andReturn($precious_user);

        $this->PreciousUsersService = new PreciousUsersService($PreciousUsers);

        // test
        $result = $this->PreciousUsersService->addPreciousUser($precious_user);
        $this->assertEquals($precious_user, $result);
    }

    /**
     * 正常系
     * @return void
     */
    public function testUpdatePreciousUserSuccess()
    {
        // setup
        $target_precious_user_id = 1;
        $precious_user = new PreciousUser();

        $PreciousUsers = Mockery::mock('PreciousUsers');
        $PreciousUsers->shouldReceive('getPreciousUser')
            ->with($target_precious_user_id)
            ->once()
            ->andReturn($precious_user);
        $PreciousUsers->shouldReceive('updatePreciousUser')
            ->with($target_precious_user_id, $precious_user)
            ->once()
            ->andReturn(true);

        $this->PreciousUsersService = new PreciousUsersService($PreciousUsers);

        // test
        $result = $this->PreciousUsersService->updatePreciousUser($target_precious_user_id, $precious_user);
        $this->assertEquals(true, $result);
    }

    /**
     * 準正常系 更新対象が見つからない時
     * @return void
     */
    public function testUpdatePreciousUserNotFound()
    {
        // setup
        $target_precious_user_id = 1;
        $precious_user = new PreciousUser();

        $PreciousUsers = Mockery::mock('PreciousUsers');
        $PreciousUsers->shouldReceive('getPreciousUser')
            ->with($target_precious_user_id)
            ->once()
            ->andReturn(null);
        $this->PreciousUsersService = new PreciousUsersService($PreciousUsers);

        // test
        $result = $this->PreciousUsersService->updatePreciousUser($target_precious_user_id, $precious_user);
        $this->assertEquals(false, $result);
    }
}
