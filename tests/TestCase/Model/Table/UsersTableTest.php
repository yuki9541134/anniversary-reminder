<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Entity\User;
use App\Model\Table\UsersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * @property UsersTable $Users
 */
class UsersTableTest extends TestCase
{
    public $fixtures = ['app.Users'];
    private $Users;

    /**
     * setUp method
     * @return void
     * テスト前に毎回実行される
     */
    public function setUp()
    {
        parent::setUp();
        $this->Users = TableRegistry::getTableLocator()->get('Users');
    }

    /**
     * Validation 正常系
     * @return void
     */
    public function testValidationDefaultSuccess()
    {
        $user = $this->Users->newEntity([
            'email' => 'test@example.com',
            'password' => 'password',
        ]);
        $this->assertEmpty($user->getErrors());
    }

    /**
     * Validation 異常系 emailとpasswordが空の時
     * @return void
     */
    public function testValidationDefaultFailedWithEmpty()
    {
        $user = $this->Users->newEntity([
            'email' => '',
            'password' => '',
        ]);
        $errors = $user->getErrors();
        $this->assertNotEmpty($errors['email']['_empty']);
        $this->assertNotEmpty($errors['password']['_empty']);
    }

    /**
     * Validation 異常系 型が正しくない時
     * @return void
     */
    public function testValidationDefaultFailedWithInvalidType()
    {
        // passwordの型が正しくないというWarningが表示されるが、今回は意図通りのため
        error_reporting(0);

        $user = $this->Users->newEntity([
            'id' => 'aaa',
            'email' => 'aaa',
            'password' => [0],
        ]);
        $errors = $user->getErrors();
        $this->assertNotEmpty($errors['id']['integer']);
        $this->assertNotEmpty($errors['email']['email']);
        $this->assertNotEmpty($errors['password']['scalar']);

        error_reporting(-1);
    }

    /**
     * Validation 異常系 文字列が長すぎる時
     * @return void
     */
    public function testValidationDefaultFailedWithTooLong()
    {
        $user = $this->Users->newEntity([
            'email' => 'test@pexample.com',
            'password' => str_repeat("a", 1000),
        ]);
        $errors = $user->getErrors();
        $this->assertNotEmpty($errors['password']['maxLength']);
    }

    /**
     * RulesChecker 異常系 emailが重複する時
     * @return void
     */
    public function testRulesCheckerFailedWithDuplicatedEmail()
    {
        $user = $this->Users->newEntity([
            'email' => 'test1@example.com',
            'password' => 'password',
        ]);
        $this->Users->save($user);
        $errors = $user->getErrors();
        $this->assertNotEmpty($errors['email']['_isUnique']);
    }

    /**
     * 正常系
     * @return void
     */
    public function testAddUser()
    {
        $user = $this->Users->newEntity([
            'email' => 'test@example.com',
            'password' => 'password',
        ]);
        $result = $this->Users->addUser($user);
        $this->assertInstanceOf(User::class, $result);
        $this->assertEquals($user->email, $result->email);
    }

    /**
     * 異常系 emailが空の時
     * @return void
     */
    public function testAddUserFailed()
    {
        $user = $this->Users->newEntity([
            'email' => '',
            'password' => 'password',
        ]);
        $result = $this->Users->addUser($user);
        $this->assertEquals(false, $result);
    }
}
