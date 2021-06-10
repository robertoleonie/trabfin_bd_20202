<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TbParticipantsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TbParticipantsTable Test Case
 */
class TbParticipantsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TbParticipantsTable
     */
    public $TbParticipants;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TbParticipants',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TbParticipants') ? [] : ['className' => TbParticipantsTable::class];
        $this->TbParticipants = TableRegistry::getTableLocator()->get('TbParticipants', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TbParticipants);

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
