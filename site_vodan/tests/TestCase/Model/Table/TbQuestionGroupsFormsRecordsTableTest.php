<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TbQuestionGroupsFormsRecordsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TbQuestionGroupsFormsRecordsTable Test Case
 */
class TbQuestionGroupsFormsRecordsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TbQuestionGroupsFormsRecordsTable
     */
    public $TbQuestionGroupsFormsRecords;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TbQuestionGroupsFormsRecords',
        'app.FormRecords',
        'app.TbCrfforms',
        'app.TbListOfValues',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TbQuestionGroupsFormsRecords') ? [] : ['className' => TbQuestionGroupsFormsRecordsTable::class];
        $this->TbQuestionGroupsFormsRecords = TableRegistry::getTableLocator()->get('TbQuestionGroupsFormsRecords', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TbQuestionGroupsFormsRecords);

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
