<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TbQuestiongroupformrecordTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TbQuestiongroupformrecordTable Test Case
 */
class TbQuestiongroupformrecordTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TbQuestiongroupformrecordTable
     */
    protected $TbQuestiongroupformrecord;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.TbQuestiongroupformrecord',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('TbQuestiongroupformrecord') ? [] : ['className' => TbQuestiongroupformrecordTable::class];
        $this->TbQuestiongroupformrecord = $this->getTableLocator()->get('TbQuestiongroupformrecord', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->TbQuestiongroupformrecord);

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
