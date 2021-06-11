<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\QuestionGroupsFormsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\QuestionGroupsFormsTable Test Case
 */
class QuestionGroupsFormsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\QuestionGroupsFormsTable
     */
    public $QuestionGroupsForms;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.QuestionGroupsForms',
        'app.Crfforms',
        'app.Questions',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('QuestionGroupsForms') ? [] : ['className' => QuestionGroupsFormsTable::class];
        $this->QuestionGroupsForms = TableRegistry::getTableLocator()->get('QuestionGroupsForms', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->QuestionGroupsForms);

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
