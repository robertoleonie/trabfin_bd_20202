<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TbQuestionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TbQuestionsTable Test Case
 */
class TbQuestionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TbQuestionsTable
     */
    public $TbQuestions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TbQuestions',
        'app.TbQuestionTypes',
        'app.TbListOfValues',
        'app.TbQuestionGroups',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TbQuestions') ? [] : ['className' => TbQuestionsTable::class];
        $this->TbQuestions = TableRegistry::getTableLocator()->get('TbQuestions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TbQuestions);

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
