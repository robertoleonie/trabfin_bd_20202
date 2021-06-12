<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;
/**
 * ListOfValues Model
 *
 * @property \App\Model\Table\ListTypesTable&\Cake\ORM\Association\BelongsTo $ListTypes
 *
 * @method \App\Model\Entity\ListOfValue get($primaryKey, $options = [])
 * @method \App\Model\Entity\ListOfValue newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ListOfValue[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ListOfValue|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ListOfValue saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ListOfValue patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ListOfValue[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ListOfValue findOrCreate($search, callable $callback = null, $options = [])
 */
class ListOfValuesTable extends Table
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

        $this->setTable('list_of_values');
        $this->setDisplayField('list_of_value_id');
        $this->setPrimaryKey('list_of_value_id');

        $this->belongsTo('ListTypes', [
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
        $rules->add($rules->existsIn(['list_type_id'], 'ListTypes'));

        return $rules;
    }
    /**
     * Clona a linha
     * 
     * @param \App\Model\Table|null Linha a ser clonada
     */
    public function clone($listOfValue){
        $connection = ConnectionManager::get('default');
        $results = $connection->execute(
            'INSERT INTO list_of_values (`description`,list_type_id) VALUES (?,?);',
            [$listOfValue->description,$listOfValue->list_type_id]
        );
    }
}
