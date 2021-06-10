<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TbAssessmentQuestionnairesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TbAssessmentQuestionnairesTable Test Case
 */
class TbAssessmentQuestionnairesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TbAssessmentQuestionnairesTable
     */
    public $TbAssessmentQuestionnaires;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TbAssessmentQuestionnaires',
        'app.TbParticipants',
        'app.TbHospitalUnits',
        'app.TbQuestionnaires',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TbAssessmentQuestionnaires') ? [] : ['className' => TbAssessmentQuestionnairesTable::class];
        $this->TbAssessmentQuestionnaires = TableRegistry::getTableLocator()->get('TbAssessmentQuestionnaires', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TbAssessmentQuestionnaires);

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
