<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HospitalUnitsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HospitalUnitsTable Test Case
 */
class HospitalUnitsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\HospitalUnitsTable
     */
    public $HospitalUnits;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.HospitalUnits',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('HospitalUnits') ? [] : ['className' => HospitalUnitsTable::class];
        $this->HospitalUnits = TableRegistry::getTableLocator()->get('HospitalUnits', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->HospitalUnits);

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
