<?php
namespace App\Test\TestCase\Controller;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;

class PreciousUsersControllerTest extends IntegrationTestCase
{
    public $fixtures = ['app.PreciousUsers'];
    /**
     * 正常系
     * 
     * @retrun void
     */
    public function testIndex()
    {
        $this->get('/precious-users/index');
        $this->assertResponseOk();
    }
    /**
     * 正常系
     * 
     * @retrun void
     */
    public function testAddGet()
    {
        $this->get('/precious-users/add');
        $this->assertResponseOk();
    }
    /**
     * 正常系
     * 
     * @retrun void
     */
    public function testAddPostSuccess()
    {
        $body = [
            'user_id' => 1,
            'name' => 'aaa',
            'gender' => 0,
            'relation' => 0,
        ];
        $this->post('/precious-users/add', $body);
        $this->assertRedirect();
        $this->assertSession('大切な人を追加しました。', 'Flash.flash.0.message');
    }
    /**
     * 異常系（nameが空のとき）
     * 
     * @retrun void
     */
    public function testAddPostFail()
    {
        $body = [
            'user_id' => 1,
            'name' => '',
            'gender' => 0,
            'relation' => 0,
        ];
        $this->enableRetainFlashMessages();
        $this->post('/precious-users/add', $body);
        $this->assertNoRedirect();
        $this->assertSession('大切な人の追加に失敗しました。', 'Flash.flash.0.message');
    }
}
