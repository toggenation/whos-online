<?php
declare(strict_types=1);

namespace WhosOnline\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use WhosOnline\Controller\WhosOnlineController;

/**
 * WhosOnline\Controller\WhosOnlineController Test Case
 *
 * @uses \WhosOnline\Controller\WhosOnlineController
 */
class WhosOnlineControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'plugin.WhosOnline.WhosOnline',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \WhosOnline\Controller\WhosOnlineController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \WhosOnline\Controller\WhosOnlineController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \WhosOnline\Controller\WhosOnlineController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \WhosOnline\Controller\WhosOnlineController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \WhosOnline\Controller\WhosOnlineController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
