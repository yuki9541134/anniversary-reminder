<?php
namespace App\Test\TestCase\Service;

use App\Service\PreciousUsersService;
use Cake\TestSuite\TestCase;

class ProductsServiceTest extends TestCase
{
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

    public function testGetPreciousUsers()
    {     
        $query = $this->PreciousUsersService->getPreciousUsers(); 
        $this->assertInstanceOf('Cake\ORM\Query', $query);
    }
}
