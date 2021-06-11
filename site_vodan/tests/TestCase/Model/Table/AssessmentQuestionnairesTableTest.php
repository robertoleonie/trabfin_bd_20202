<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AssessmentQuestionnairesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AssessmentQuestionnairesTable Test Case
 */
class AssessmentQuestionnairesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AssessmentQuestionnairesTable
     */
    public $AssessmentQuestionnaires;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.AssessmentQuestionnaires',
        'app.Participants',
        'app.HospitalUnits',
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
        $config = TableRegistry::getTableLocator()->exists('AssessmentQuestionnaires') ? [] : ['className' => AssessmentQuestionnairesTable::class];
        $this->AssessmentQuestionnaires = TableRegistry::getTableLocator()->get('AssessmentQuestionnaires', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AssessmentQuestionnaires);

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
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
