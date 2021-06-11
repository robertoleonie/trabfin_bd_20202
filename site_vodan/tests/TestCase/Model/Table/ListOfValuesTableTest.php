<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ListOfValuesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ListOfValuesTable Test Case
 */
class ListOfValuesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ListOfValuesTable
     */
    public $ListOfValues;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ListOfValues',
        'app.ListTypes',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ListOfValues') ? [] : ['className' => ListOfValuesTable::class];
        $this->ListOfValues = TableRegistry::getTableLocator()->get('ListOfValues', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ListOfValues);

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
