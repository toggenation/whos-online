<?php
declare(strict_types=1);

namespace WhosOnline\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * WhosOnlineFixture
 */
class WhosOnlineFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'whos_online';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'ip' => 1,
                'url' => 'Lorem ipsum dolor sit amet',
                'session_id' => 'Lorem ipsum dolor sit amet',
                'created' => 1669582856,
                'modified' => 1669582856,
            ],
        ];
        parent::init();
    }
}
