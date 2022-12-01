<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class WhosOnline extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $this->table('whos_online')
            ->addColumn('ip', 'string', [
                'null' => false, 'default' => NULL,
            ])
            ->addColumn('user_id', 'integer', ['null' => true, 'default' => NULL])
            ->addColumn('url', 'string', ['null' => true, 'default' => NULL])
            ->addColumn('user_agent', 'string', ['null' => true, 'default' => NULL])
            ->addColumn('ip_agent_hash', 'string')
            ->addColumn('php_session_id', 'string', ['null' => true, 'default' => NULL])
            ->addTimestamps('created', 'modified')
            ->create();


        if ($this->isMigratingUp()) {
            $this->execute('ALTER TABLE whos_online ADD CONSTRAINT whos_online_ip_agent_hash_uq UNIQUE (ip_agent_hash);');
        } else {
            $this->execute('ALTER TABLE whos_online DROP CONSTRAINT whos_online_ip_agent_hash_uq;');
        }


        /**
         * 'ip' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'unique'),
		'url' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('ip' => array('column' => 'ip', 'unique' => 1))
         */
    }
}
