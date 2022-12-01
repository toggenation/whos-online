<?php

declare(strict_types=1);

namespace WhosOnline\Model\Entity;

use Cake\ORM\Entity;

/**
 * WhosOnline Entity
 *
 * @property int $id
 * @property int $ip
 * @property string|null $url
 * @property string|null $session_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \WhosOnline\Model\Entity\Phinxlog[] $phinxlog
 */
class WhosOnline extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'ip' => true,
        'url' => true,
        'user_id' => true,
        'php_session_id' => true,
        'created' => true,
        'ip_agent_hash' => true,
        'user_agent' => true,
        'modified' => true,
    ];
}
