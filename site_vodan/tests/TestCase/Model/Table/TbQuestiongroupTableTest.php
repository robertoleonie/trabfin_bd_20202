<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TbQuestiongroupTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TbQuestiongroupTable Test Case
 */
class TbQuestiongroupTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TbQuestiongroupTable
     */
    protected $TbQuestiongroup;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.TbQuestiongroup',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('TbQuestiongroup') ? [] : ['className' => TbQuestiongroupTable::class];
        $this->TbQuestiongroup = $this->getTableLocator()->get('TbQuestiongroup', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->TbQuestiongroup);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
