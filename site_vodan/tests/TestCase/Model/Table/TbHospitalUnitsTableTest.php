<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TbHospitalUnitsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TbHospitalUnitsTable Test Case
 */
class TbHospitalUnitsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TbHospitalUnitsTable
     */
    public $TbHospitalUnits;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TbHospitalUnits',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TbHospitalUnits') ? [] : ['className' => TbHospitalUnitsTable::class];
        $this->TbHospitalUnits = TableRegistry::getTableLocator()->get('TbHospitalUnits', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TbHospitalUnits);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
