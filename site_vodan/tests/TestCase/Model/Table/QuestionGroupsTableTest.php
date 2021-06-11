<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\QuestionGroupsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\QuestionGroupsTable Test Case
 */
class QuestionGroupsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\QuestionGroupsTable
     */
    public $QuestionGroups;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.QuestionGroups',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('QuestionGroups') ? [] : ['className' => QuestionGroupsTable::class];
        $this->QuestionGroups = TableRegistry::getTableLocator()->get('QuestionGroups', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->QuestionGroups);

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
