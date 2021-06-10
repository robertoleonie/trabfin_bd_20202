<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TbQuestionnairesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TbQuestionnairesTable Test Case
 */
class TbQuestionnairesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TbQuestionnairesTable
     */
    public $TbQuestionnaires;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $config = TableRegistry::getTableLocator()->exists('TbQuestionnaires') ? [] : ['className' => TbQuestionnairesTable::class];
        $this->TbQuestionnaires = TableRegistry::getTableLocator()->get('TbQuestionnaires', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TbQuestionnaires);

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
