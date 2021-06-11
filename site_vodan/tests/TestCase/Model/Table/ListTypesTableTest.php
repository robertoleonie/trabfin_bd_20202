<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ListTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ListTypesTable Test Case
 */
class ListTypesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ListTypesTable
     */
    public $ListTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $config = TableRegistry::getTableLocator()->exists('ListTypes') ? [] : ['className' => ListTypesTable::class];
        $this->ListTypes = TableRegistry::getTableLocator()->get('ListTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ListTypes);

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
