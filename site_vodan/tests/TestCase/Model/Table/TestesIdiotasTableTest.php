<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TestesIdiotasTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TestesIdiotasTable Test Case
 */
class TestesIdiotasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TestesIdiotasTable
     */
    protected $TestesIdiotas;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.TestesIdiotas',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('TestesIdiotas') ? [] : ['className' => TestesIdiotasTable::class];
        $this->TestesIdiotas = $this->getTableLocator()->get('TestesIdiotas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->TestesIdiotas);

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
