<?php
namespace App\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;

class PreciousUsersControllerTest extends IntegrationTestCase
{
    public $fixtures = ['app.PreciousUsers'];

    /**
     * 正常系
     * @retrun void
     */
    public function testIndex()
    {
        $this->get('/precious-users/index');
        $this->assertResponseOk();
    }

    /**
     * 正常系
     * @retrun void
     */
    public function testNew()
    {
        $this->get('/precious-users/new');
        $this->assertResponseOk();
    }

    /**
     * 正常系
     * @retrun void
     */
    public function testAdd()
    {
        $body = [
            'user_id' => 1,
            'name' => 'aaa',
            'gender' => 0,
            'relation' => 0,
        ];
        $this->post('/precious-users/add', $body);
        $this->assertRedirect('/precious-users/index');
        $this->assertSession('大切な人を追加しました。', 'Flash.flash.0.message');
    }

    /**
     * 異常系（nameが空のとき）
     * @retrun void
     */
    public function testAddFailed()
    {
        $body = [
            'user_id' => 1,
            'name' => '',
            'gender' => 0,
            'relation' => 0,
        ];
        $this->enableRetainFlashMessages();
        $this->post('/precious-users/add', $body);
        $this->assertRedirect('/precious-users/new');
        $this->assertSession('大切な人の追加に失敗しました。', 'Flash.flash.0.message');
    }
}
