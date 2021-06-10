<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TbListTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TbListTypesTable Test Case
 */
class TbListTypesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TbListTypesTable
     */
    public $TbListTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TbListTypes',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TbListTypes') ? [] : ['className' => TbListTypesTable::class];
        $this->TbListTypes = TableRegistry::getTableLocator()->get('TbListTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TbListTypes);

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
