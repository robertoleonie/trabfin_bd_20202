<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FormRecordsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FormRecordsTable Test Case
 */
class FormRecordsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FormRecordsTable
     */
    public $FormRecords;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.FormRecords',
        'app.Participants',
        'app.HospitalUnits',
        'app.Questionnaires',
        'app.Crfforms',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('FormRecords') ? [] : ['className' => FormRecordsTable::class];
        $this->FormRecords = TableRegistry::getTableLocator()->get('FormRecords', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FormRecords);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
