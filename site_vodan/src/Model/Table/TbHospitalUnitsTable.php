<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TbHospitalUnits Model
 *
 * @method \App\Model\Entity\TbHospitalUnit get($primaryKey, $options = [])
 * @method \App\Model\Entity\TbHospitalUnit newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TbHospitalUnit[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TbHospitalUnit|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TbHospitalUnit saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TbHospitalUnit patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TbHospitalUnit[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TbHospitalUnit findOrCreate($search, callable $callback = null, $options = [])
 */
class TbHospitalUnitsTable extends Table
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

        $this->setTable('tb_hospital_units');
        $this->setDisplayField('hospital_unit_id');
        $this->setPrimaryKey('hospital_unit_id');
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
            ->integer('hospital_unit_id')
            ->allowEmptyString('hospital_unit_id', null, 'create');

        $validator
            ->scalar('hospitalUnitName')
            ->maxLength('hospitalUnitName', 500)
            ->requirePresence('hospitalUnitName', 'create')
            ->notEmptyString('hospitalUnitName');

        return $validator;
    }
}
