<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TbCrfformsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TbCrfformsTable Test Case
 */
class TbCrfformsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TbCrfformsTable
     */
    public $TbCrfforms;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TbCrfforms',
        'app.Questionnaires',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TbCrfforms') ? [] : ['className' => TbCrfformsTable::class];
        $this->TbCrfforms = TableRegistry::getTableLocator()->get('TbCrfforms', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TbCrfforms);

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
