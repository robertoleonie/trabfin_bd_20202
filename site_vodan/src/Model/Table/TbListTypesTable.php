<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TbListTypes Model
 *
 * @method \App\Model\Entity\TbListType get($primaryKey, $options = [])
 * @method \App\Model\Entity\TbListType newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TbListType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TbListType|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TbListType saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TbListType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TbListType[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TbListType findOrCreate($search, callable $callback = null, $options = [])
 */
class TbListTypesTable extends Table
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

        $this->setTable('tb_list_types');
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
