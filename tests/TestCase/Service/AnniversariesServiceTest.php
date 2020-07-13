<?php
namespace App\Test\TestCase\Service;

use App\Model\Entity\Anniversary;
use App\Service\AnniversariesService;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Mockery;

/**
 * @property AnniversariesService $AnniversariesService
 */
class AnniversariesServiceTest extends TestCase
{
    public $fixtures = ['app.Users', 'app.PreciousUsers', 'app.Anniversaries'];
    private $AnniversariesService;

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
     * @return void
     */
    public function testFindAnniversaries()
    {
        // setup
        $this->AnniversariesService = new AnniversariesService(TableRegistry::get('Anniversaries'));

        // test
        $result = $this->AnniversariesService->findAnniversaries(1);
        $this->assertInstanceOf('Cake\ORM\Query', $result);
    }

    /**
     * 正常系
     * @return void
     */
    public function testAddAnniversary()
    {
        // setup
        $anniversary = new Anniversary([
            'user_id' => 1,
            'precious_user_id' => 1,
            'anniversary_type' => 1,
            'anniversary_date' => '2020-06-30 00:00:00',
        ]);

        $Anniversaries = Mockery::mock('App\Model\Table\AnniversariesTable');
        $Anniversaries->shouldReceive('addAnniversary')
            ->with($anniversary)
            ->once()
            ->andReturn($anniversary);

        $this->AnniversariesService = new AnniversariesService($Anniversaries);

        // test
        $result = $this->AnniversariesService->addAnniversary($anniversary);
        $this->assertEquals($anniversary, $result);
    }
}
