<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ListTypes Model
 *
 * @method \App\Model\Entity\ListType get($primaryKey, $options = [])
 * @method \App\Model\Entity\ListType newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ListType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ListType|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ListType saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ListType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ListType[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ListType findOrCreate($search, callable $callback = null, $options = [])
 */
class ListTypesTable extends Table
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

        $this->setTable('list_types');
        $this->setDisplayField('list_type_id');
        $this->setPrimaryKey('list_type_id');
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
            ->integer('list_type_id')
            ->allowEmptyString('list_type_id', null, 'create');

        $validator
            ->scalar('description')
            ->maxLength('description', 255)
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        return $validator;
    }
}
