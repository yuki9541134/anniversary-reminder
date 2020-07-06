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
}
