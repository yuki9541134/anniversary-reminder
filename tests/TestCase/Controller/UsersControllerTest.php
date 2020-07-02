<?php
namespace App\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;

class UsersControllerTest extends IntegrationTestCase
{
    public $fixtures = ['app.Users'];

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
     * @retrun void
     */
    public function testLoginForm()
    {
        $this->get('/users/login_form');
        $this->assertResponseOk();
    }

    /**
     * 正常系
     * @retrun void
     */
    public function testLogin()
    {
        $body = [
            'email' => 'test1@example.com',
            'password' => 'password',
        ];
        $this->post('/users/login', $body);
        $this->assertRedirect('/precious-users/index');
        $this->assertSession('ログインしました。', 'Flash.flash.0.message');
    }

    /**
     * 異常系
     * @retrun void
     */
    public function testLoginFailed()
    {
        $body = [
            'email' => 'test1@example.com',
            'password' => 'pass',
        ];
        $this->post('/users/login', $body);
        $this->assertRedirect('/users/login_form');
        $this->assertSession('ユーザー名またはパスワードが不正です。', 'Flash.flash.0.message');
    }

    /**
     * 正常系
     * @retrun void
     */
    public function testLogout()
    {
        $this->session([
            'Auth' => [
                'User' => [
                    'id' => 1,
                    'username' => 'testing',
                ]
            ]
        ]);
        $this->get('/users/logout');
        $this->assertRedirect('/users/login_form');
        $this->assertSession('ログアウトしました。', 'Flash.flash.0.message');
    }

    /**
     * 正常系
     * @retrun void
     */
    public function testNew()
    {
        $this->get('/users/new');
        $this->assertResponseOk();
    }

    /**
     * 正常系
     * @retrun void
     */
    public function testAdd()
    {
        $body = [
            'email' => 'test2@example.com',
            'password' => 'password',
        ];
        $this->post('/users/add', $body);
        $this->assertRedirect('/users/login_form');
        $this->assertSession('ユーザー登録に成功しました。', 'Flash.flash.0.message');
    }

    /**
     * 異常系
     * @retrun void
     */
    public function testAddFailed()
    {
        $body = [
            'email' => 'test1@example.com',
            'password' => 'pass',
        ];
        $this->post('/users/add', $body);
        $this->assertRedirect('/users/new');
        $this->assertSession('ユーザー登録に失敗しました。', 'Flash.flash.0.message');
    }

    /**
     * 未ログイン時のアクセス制限のテスト
     * @retrun void
     */
    public function testAuth()
    {
        $this->get('/users/logout');
        $this->assertRedirect('/users/login_form?redirect=%2Fusers%2Flogout');
        $this->assertSession('権限がありません。', 'Flash.flash.0.message');
    }
}
