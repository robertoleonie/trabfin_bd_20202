<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TbListOfValues Model
 *
 * @property \App\Model\Table\TbListTypesTable&\Cake\ORM\Association\BelongsTo $TbListTypes
 *
 * @method \App\Model\Entity\TbListOfValue get($primaryKey, $options = [])
 * @method \App\Model\Entity\TbListOfValue newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TbListOfValue[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TbListOfValue|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TbListOfValue saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TbListOfValue patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TbListOfValue[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TbListOfValue findOrCreate($search, callable $callback = null, $options = [])
 */
class TbListOfValuesTable extends Table
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

        $this->setTable('tb_list_of_values');
        $this->setDisplayField('list_of_value_id');
        $this->setPrimaryKey('list_of_value_id');

        $this->belongsTo('TbListTypes', [
            'foreignKey' => 'list_type_id',
            'joinType' => 'INNER',
        ]);
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
            ->integer('list_of_value_id')
            ->allowEmptyString('list_of_value_id', null, 'create');

        $validator
            ->scalar('description')
            ->maxLength('description', 255)
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['list_type_id'], 'TbListTypes'));

        return $rules;
    }
}
