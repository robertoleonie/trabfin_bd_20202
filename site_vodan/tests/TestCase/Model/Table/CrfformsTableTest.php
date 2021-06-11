<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CrfformsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CrfformsTable Test Case
 */
class CrfformsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CrfformsTable
     */
    public $Crfforms;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Crfforms',
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
        $config = TableRegistry::getTableLocator()->exists('Crfforms') ? [] : ['className' => CrfformsTable::class];
        $this->Crfforms = TableRegistry::getTableLocator()->get('Crfforms', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Crfforms);

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
