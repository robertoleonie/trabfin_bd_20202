<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TbCrfforms Model
 *
 * @property \App\Model\Table\QuestionnairesTable&\Cake\ORM\Association\BelongsTo $Questionnaires
 *
 * @method \App\Model\Entity\TbCrfform get($primaryKey, $options = [])
 * @method \App\Model\Entity\TbCrfform newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TbCrfform[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TbCrfform|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TbCrfform saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TbCrfform patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TbCrfform[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TbCrfform findOrCreate($search, callable $callback = null, $options = [])
 */
class TbCrfformsTable extends Table
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

        $this->setTable('tb_crfforms');
        $this->setDisplayField('crfform_id');
        $this->setPrimaryKey('crfform_id');

        $this->belongsTo('Questionnaires', [
            'foreignKey' => 'questionnaire_id',
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
            ->integer('crfform_id')
            ->allowEmptyString('crfform_id', null, 'create');

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
        $rules->add($rules->existsIn(['questionnaire_id'], 'Questionnaires'));

        return $rules;
    }
}
