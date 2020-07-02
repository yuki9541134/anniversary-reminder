<?php
namespace App\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;

class PreciousUsersControllerTest extends IntegrationTestCase
{
    public $fixtures = ['app.PreciousUsers'];

    /**
     * setUp method
     * @return void
     * テスト前に毎回実行される
     */
    public function setUp()
    {
        parent::setUp();

        // PreciousUsersControllerのアクセスには認証が必要なため、
        // セッションデータをセットする
        $this->session([
            'Auth' => [
                'User' => [
                    'id' => 1,
                    'username' => 'testing',
                ]
            ]
        ]);
    }

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

    /**
     * 正常系
     * @retrun void
     */
    public function testEditSuccess()
    {
        $this->get('/precious-users/edit/1');
        $this->assertResponseOk();
    }

    /**
     * 異常系 対象がない or 権限がないとき
     * @retrun void
     */
    public function testEditNotFound()
    {
        $this->get('/precious-users/edit/100');
        $this->assertRedirect('/precious-users/index');
        $this->assertSession('対象が存在しないか、権限がありません。', 'Flash.flash.0.message');
    }

    /**
     * 正常系
     * @retrun void
     */
    public function testUpdateSuccess()
    {
        $body = [
            'id' => 1,
            'user_id' => 1,
            'name' => 'aaa',
            'gender' => 0,
            'relation' => 0,
        ];
        $this->post('/precious-users/update', $body);
        $this->assertRedirect('/precious-users/index');
        $this->assertSession('大切な人を更新しました。', 'Flash.flash.0.message');
    }

    /**
     * 異常系 対象がない or 権限がないとき
     * @retrun void
     */
    public function testUpdateNotFound()
    {
        $body = [
            'id' => 100,
            'user_id' => 1,
            'name' => 'aaa',
            'gender' => 0,
            'relation' => 0,
        ];
        $this->put('/precious-users/update', $body);
        $this->assertRedirect('/precious-users/index');
        $this->assertSession('対象が存在しないか、権限がありません。', 'Flash.flash.0.message');
    }

    /**
     * 正常系
     * @retrun void
     */
    public function testDeleteSuccess()
    {
        $this->delete('/precious-users/delete/1');
        $this->assertRedirect('/precious-users/index');
        $this->assertSession('大切な人を削除しました。', 'Flash.flash.0.message');
    }

    /**
     * 異常系 削除対象がない or 権限がないとき
     * @retrun void
     */
    public function testDeleteNotFound()
    {
        $this->delete('/precious-users/delete/100');
        $this->assertRedirect('/precious-users/index');
        $this->assertSession('対象が存在しないか、権限がありません。', 'Flash.flash.0.message');
    }

    /**
     * 未ログイン時のアクセス制限のテスト
     * @retrun void
     */
    public function testAuth()
    {
        $this->session(['Auth' => []]);

        $routes = [
            ['url' => 'index', 'method' => 'get'],
            ['url' => 'new', 'method' => 'get'],
            ['url' => 'add', 'method' => 'post'],
            ['url' => 'edit/1', 'method' => 'get'],
            ['url' => 'update', 'method' => 'post'],
            ['url' => 'delete/1', 'method' => 'post'],
        ];
        foreach ($routes as $route) {
            $url = '/precious-users/' . $route['url'];

            if ($route['method'] == 'get') {
                $this->get($url);
                $this->assertRedirect('/users/login_form?redirect=' . urlencode($url));
            }
            if ($route['method'] == 'post') {
                $this->post($url);
                $this->assertRedirect('/users/login_form');
            }

            $this->assertSession('権限がありません。', 'Flash.flash.0.message');
        }
    }
}
