<?php
namespace App\Test\TestCase\Service;

use App\Model\Entity\User;
use App\Service\UsersService;
use Cake\TestSuite\TestCase;
use Mockery;

/**
 * @property UsersService $UsersService
 */
class UsersServiceTest extends TestCase
{
    private $UsersService;

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
    public function testAddUser()
    {
        // setup
        $user = new User([
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $Users = Mockery::mock('App\Model\Table\UsersTable');
        $Users->shouldReceive('addUser')
            ->with($user)
            ->once()
            ->andReturn($user);

        $this->UsersService = new UsersService($Users);

        // test
        $result = $this->UsersService->addUser($user);
        $this->assertEquals($user, $result);
    }
}
