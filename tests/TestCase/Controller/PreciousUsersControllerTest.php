<?php
namespace App\Test\TestCase\Controller;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;

class PreciousUsersControllerTest extends IntegrationTestCase
{
    public $fixtures = ['app.PreciousUsers'];

    public function testIndex()
    {
        $this->get('/precious-users/index');
        $this->assertResponseOk();
    }
}
