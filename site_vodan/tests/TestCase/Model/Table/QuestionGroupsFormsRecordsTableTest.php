<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\QuestionGroupsFormsRecordsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\QuestionGroupsFormsRecordsTable Test Case
 */
class QuestionGroupsFormsRecordsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\QuestionGroupsFormsRecordsTable
     */
    public $QuestionGroupsFormsRecords;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.QuestionGroupsFormsRecords',
        'app.FormRecords',
        'app.Crfforms',
        'app.Questions',
        'app.ListOfValues',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('QuestionGroupsFormsRecords') ? [] : ['className' => QuestionGroupsFormsRecordsTable::class];
        $this->QuestionGroupsFormsRecords = TableRegistry::getTableLocator()->get('QuestionGroupsFormsRecords', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->QuestionGroupsFormsRecords);

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
