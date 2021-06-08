<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TbQuestiontypeTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TbQuestiontypeTable Test Case
 */
class TbQuestiontypeTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TbQuestiontypeTable
     */
    protected $TbQuestiontype;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.TbQuestiontype',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('TbQuestiontype') ? [] : ['className' => TbQuestiontypeTable::class];
        $this->TbQuestiontype = $this->getTableLocator()->get('TbQuestiontype', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->TbQuestiontype);

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
