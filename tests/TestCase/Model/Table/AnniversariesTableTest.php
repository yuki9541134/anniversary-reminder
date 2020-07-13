<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Entity\Anniversary;
use App\Model\Entity\User;
use App\Model\Table\AnniversariesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Cake\I18n\FrozenTime;

/**
 * @property AnniversariesTable $Anniversaries
 */
class AnniversariesTableTest extends TestCase
{
    public $fixtures = ['app.Users', 'app.PreciousUsers', 'app.Anniversaries'];
    private $Anniversaries;

    /**
     * setUp method
     * @return void
     * テスト前に毎回実行される
     */
    public function setUp()
    {
        parent::setUp();
        $this->Anniversaries = TableRegistry::getTableLocator()->get('Anniversaries');
    }

    /**
     * 正常系
     * @return void
     */
    public function testFindAnniversaries()
    {
        $query = $this->Anniversaries->findAnniversaries(1);
        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->enableHydration(false)->toArray();

        // ユーザーのpasswordを一致させることができないため
        $result[0]['user']['password'] = '';

        $expected = [
            [
                'id' => 1,
                'user_id' => 1,
                'precious_user_id' => 1,
                'anniversary_type' => '誕生日',
                'anniversary_date' => new FrozenTime('2020-07-10 00:00:00'),
                'created' => new FrozenTime('2007-03-18 10:39:23'),
                'modified' => new FrozenTime('2007-03-18 10:41:31'),
                'precious_user' => [
                    'id' => 1,
                    'user_id' => 1,
                    'name' => 'First Person',
                    'gender' => '男性',
                    'relation' => '父親',
                    'created' => new FrozenTime('2007-03-18 10:39:23'),
                    'modified' => new FrozenTime('2007-03-18 10:41:31'),
                ],
                'user' => [
                    'id' => 1,
                    'email' => 'test1@example.com',
                    'password' => '',
                    'created' => new FrozenTime('2007-03-18 10:39:23'),
                    'modified' => new FrozenTime('2007-03-18 10:41:31'),
                ],
            ],
        ];

        $this->assertEquals($expected, $result);
    }

    /**
     * 正常系
     * @return void
     */
    public function testAddAnniversarySuccess()
    {
        $anniversary = $this->Anniversaries->newEntity([
            'user_id' => 1,
            'precious_user_id' => 1,
            'anniversary_type' => 1,
            'anniversary_date' => '2020-06-30 00:00:00',
        ]);
        $result = $this->Anniversaries->addAnniversary($anniversary);
        $this->assertEquals($anniversary, $result);
    }

    /**
     * 異常系 user_idが空の時
     * @return void
     */
    public function testAddAnniversaryFailed()
    {
        $anniversary = $this->Anniversaries->newEntity([
            'user_id' => null,
            'precious_user_id' => 1,
            'anniversary_type' => 1,
            'anniversary_date' => '2020-06-30 00:00:00',
        ]);
        $result = $this->Anniversaries->addAnniversary($anniversary);
        $this->assertEquals(false, $result);
    }

    /**
     * Validation 正常系
     * @return void
     */
    public function testValidationDefaultSuccess()
    {
        $anniversary = $this->Anniversaries->newEntity([
            'user_id' => 1,
            'precious_user_id' => 1,
            'anniversary_type' => 1,
            'anniversary_date' => '2020-06-30 00:00:00',
        ]);
        $this->assertEmpty($anniversary->getErrors());
    }

    /**
     * Validation 空の時
     * @return void
     */
    public function testValidationDefaultFailedWithNullValue()
    {
        $anniversary = $this->Anniversaries->newEntity([
            'user_id' => null,
            'precious_user_id' => null,
            'anniversary_type' => null,
            'anniversary_date' => null,
        ]);
        $errors = $anniversary->getErrors();
        $this->assertNotEmpty($errors['user_id']['_empty']);
        $this->assertNotEmpty($errors['precious_user_id']['_empty']);
        $this->assertNotEmpty($errors['anniversary_type']['_empty']);
        $this->assertNotEmpty($errors['anniversary_date']['_empty']);
    }

    /**
     * Validation 型が合わない時
     * @return void
     */
    public function testValidationDefaultFailedWithInvalidType()
    {
        $anniversary = $this->Anniversaries->newEntity([
            'user_id' => 'aaa',
            'precious_user_id' => 'aaa',
            'anniversary_type' => 'aaa',
            'anniversary_date' => 'aaa',
        ]);
        $errors = $anniversary->getErrors();
        $this->assertNotEmpty($errors['user_id']['integer']);
        $this->assertNotEmpty($errors['precious_user_id']['integer']);
        $this->assertNotEmpty($errors['anniversary_type']['integer']);
        $this->assertNotEmpty($errors['anniversary_date']['dateTime']);
    }

    /**
     * RulesChecker 異常系 ユーザーIDと大切な人IDが存在しないとき
     * @return void
     */
    public function testRulesCheckerFailedWithInvalidForeignKey()
    {
        $anniversary = $this->Anniversaries->newEntity([
            'user_id' => 100,
            'precious_user_id' => 100,
            'anniversary_type' => 1,
            'anniversary_date' => '2020-06-30 00:00:00',
        ]);
        $this->Anniversaries->save($anniversary);
        $errors = $anniversary->getErrors();
        $this->assertNotEmpty($errors['user_id']['_existsIn']);
        $this->assertNotEmpty($errors['precious_user_id']['_existsIn']);
    }
}
