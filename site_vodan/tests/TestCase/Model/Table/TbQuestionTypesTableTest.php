<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TbQuestionTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TbQuestionTypesTable Test Case
 */
class TbQuestionTypesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TbQuestionTypesTable
     */
    public $TbQuestionTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TbQuestionTypes',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TbQuestionTypes') ? [] : ['className' => TbQuestionTypesTable::class];
        $this->TbQuestionTypes = TableRegistry::getTableLocator()->get('TbQuestionTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TbQuestionTypes);

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
