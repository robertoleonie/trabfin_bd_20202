<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TbQuestionGroupsFormsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TbQuestionGroupsFormsTable Test Case
 */
class TbQuestionGroupsFormsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TbQuestionGroupsFormsTable
     */
    public $TbQuestionGroupsForms;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TbQuestionGroupsForms',
        'app.TbCrfforms',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TbQuestionGroupsForms') ? [] : ['className' => TbQuestionGroupsFormsTable::class];
        $this->TbQuestionGroupsForms = TableRegistry::getTableLocator()->get('TbQuestionGroupsForms', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TbQuestionGroupsForms);

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
