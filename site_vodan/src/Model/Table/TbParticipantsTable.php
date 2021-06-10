<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TbParticipants Model
 *
 * @method \App\Model\Entity\TbParticipant get($primaryKey, $options = [])
 * @method \App\Model\Entity\TbParticipant newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TbParticipant[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TbParticipant|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TbParticipant saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TbParticipant patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TbParticipant[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TbParticipant findOrCreate($search, callable $callback = null, $options = [])
 */
class TbParticipantsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('tb_participants');
        $this->setDisplayField('participant_id');
        $this->setPrimaryKey('participant_id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('participant_id')
            ->allowEmptyString('participant_id', null, 'create');

        $validator
            ->scalar('medicalRecord')
            ->maxLength('medicalRecord', 500)
            ->requirePresence('medicalRecord', 'create')
            ->notEmptyString('medicalRecord');

        return $validator;
    }
}
