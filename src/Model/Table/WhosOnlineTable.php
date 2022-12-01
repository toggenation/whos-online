<?php

declare(strict_types=1);

namespace WhosOnline\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * WhosOnline Model
 *
 * @property \WhosOnline\Model\Table\PhinxlogTable&\Cake\ORM\Association\BelongsToMany $Phinxlog
 *
 * @method \WhosOnline\Model\Entity\WhosOnline newEmptyEntity()
 * @method \WhosOnline\Model\Entity\WhosOnline newEntity(array $data, array $options = [])
 * @method \WhosOnline\Model\Entity\WhosOnline[] newEntities(array $data, array $options = [])
 * @method \WhosOnline\Model\Entity\WhosOnline get($primaryKey, $options = [])
 * @method \WhosOnline\Model\Entity\WhosOnline findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \WhosOnline\Model\Entity\WhosOnline patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \WhosOnline\Model\Entity\WhosOnline[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \WhosOnline\Model\Entity\WhosOnline|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \WhosOnline\Model\Entity\WhosOnline saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \WhosOnline\Model\Entity\WhosOnline[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \WhosOnline\Model\Entity\WhosOnline[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \WhosOnline\Model\Entity\WhosOnline[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \WhosOnline\Model\Entity\WhosOnline[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class WhosOnlineTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('whos_online');
        $this->setDisplayField('ip');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('ip')
            ->requirePresence('ip', 'create')
            ->notEmptyString('ip');

        $validator
            ->scalar('url')
            ->maxLength('url', 255)
            ->allowEmptyString('url');

        $validator
            ->scalar('php_session_id')
            ->maxLength('php_session_id', 255)
            ->allowEmptyString('php_session_id');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['ip_agent_hash']), [
            'message' => 'IP Agent Hash must be unique',
        ]);

        return $rules;
    }
}
