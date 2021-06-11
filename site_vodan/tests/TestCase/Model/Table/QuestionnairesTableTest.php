<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\QuestionnairesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\QuestionnairesTable Test Case
 */
class QuestionnairesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\QuestionnairesTable
     */
    public $Questionnaires;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $config = TableRegistry::getTableLocator()->exists('Questionnaires') ? [] : ['className' => QuestionnairesTable::class];
        $this->Questionnaires = TableRegistry::getTableLocator()->get('Questionnaires', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Questionnaires);

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
