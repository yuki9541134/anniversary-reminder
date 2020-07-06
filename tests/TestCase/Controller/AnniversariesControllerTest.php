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
     * 未ログイン時のアクセス制限のテスト
     * @retrun void
     */
    public function testAuth()
    {
        $this->session(['Auth' => []]);

        $routes = [
            ['url' => 'index', 'method' => 'get'],
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
