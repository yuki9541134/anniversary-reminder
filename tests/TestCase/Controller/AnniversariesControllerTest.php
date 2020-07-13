<?php
namespace App\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;

class AnniversariesControllerTest extends IntegrationTestCase
{
    public $fixtures = ['app.Users', 'app.PreciousUsers', 'app.Anniversaries'];

    /**
     * setUp method
     * @return void
     * テスト前に毎回実行される
     */
    public function setUp()
    {
        parent::setUp();

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
        $this->get('/anniversaries/index');
        $this->assertResponseOk();
    }

    /**
     * 正常系
     * @retrun void
     */
    public function testNew()
    {
        $this->get('/anniversaries/new');
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
            'precious_user_id' => 1,
            'anniversary_type' => 1,
            'anniversary_date' => '2020-01-01 00:00:00',
        ];
        $this->post('/anniversaries/add', $body);
        $this->assertRedirect('/anniversaries/index');
        $this->assertSession('記念日を追加しました。', 'Flash.flash.0.message');
    }

    /**
     * 異常系 記念日の日付が空の時
     * @retrun void
     */
    public function testAddFailed()
    {
        $body = [
            'user_id' => 1,
            'precious_user_id' => 1,
            'anniversary_type' => 1,
            'anniversary_date' => '',
        ];
        $this->post('/anniversaries/add', $body);
        $this->assertRedirect('/anniversaries/new');
        $this->assertSession('記念日の追加に失敗しました。', 'Flash.flash.0.message');
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
        ];
        foreach ($routes as $route) {
            $url = '/anniversaries/' . $route['url'];

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
