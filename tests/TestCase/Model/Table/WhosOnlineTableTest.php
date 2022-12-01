<?php
declare(strict_types=1);

namespace WhosOnline\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use WhosOnline\Model\Table\WhosOnlineTable;

/**
 * WhosOnline\Model\Table\WhosOnlineTable Test Case
 */
class WhosOnlineTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \WhosOnline\Model\Table\WhosOnlineTable
     */
    protected $WhosOnline;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'plugin.WhosOnline.WhosOnline',
        'plugin.WhosOnline.Phinxlog',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('WhosOnline') ? [] : ['className' => WhosOnlineTable::class];
        $this->WhosOnline = $this->getTableLocator()->get('WhosOnline', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->WhosOnline);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \WhosOnline\Model\Table\WhosOnlineTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \WhosOnline\Model\Table\WhosOnlineTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
