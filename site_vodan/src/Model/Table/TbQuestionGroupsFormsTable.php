<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TbQuestionGroupsForms Model
 *
 * @property \App\Model\Table\TbCrfformsTable&\Cake\ORM\Association\BelongsTo $TbCrfforms
 *
 * @method \App\Model\Entity\TbQuestionGroupsForm get($primaryKey, $options = [])
 * @method \App\Model\Entity\TbQuestionGroupsForm newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TbQuestionGroupsForm[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TbQuestionGroupsForm|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TbQuestionGroupsForm saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TbQuestionGroupsForm patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TbQuestionGroupsForm[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TbQuestionGroupsForm findOrCreate($search, callable $callback = null, $options = [])
 */
class TbQuestionGroupsFormsTable extends Table
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

        $this->setTable('tb_question_groups_forms');
        $this->setDisplayField('crfform_id');
        $this->setPrimaryKey(['crfform_id', 'question_idb']);

        $this->belongsTo('TbCrfforms', [
            'foreignKey' => 'crfform_id',
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
            ->integer('question_idb')
            ->allowEmptyString('question_idb', null, 'create');

        $validator
            ->integer('questionOrder')
            ->requirePresence('questionOrder', 'create')
            ->notEmptyString('questionOrder');

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
        $rules->add($rules->existsIn(['crfform_id'], 'TbCrfforms'));

        return $rules;
    }
}
