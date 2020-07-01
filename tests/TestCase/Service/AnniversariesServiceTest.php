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
}
