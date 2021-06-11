<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * QuestionGroupsForms Model
 *
 * @property \App\Model\Table\CrfformsTable&\Cake\ORM\Association\BelongsTo $Crfforms
 * @property \App\Model\Table\QuestionsTable&\Cake\ORM\Association\BelongsTo $Questions
 *
 * @method \App\Model\Entity\QuestionGroupsForm get($primaryKey, $options = [])
 * @method \App\Model\Entity\QuestionGroupsForm newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\QuestionGroupsForm[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\QuestionGroupsForm|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\QuestionGroupsForm saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\QuestionGroupsForm patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\QuestionGroupsForm[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\QuestionGroupsForm findOrCreate($search, callable $callback = null, $options = [])
 */
class QuestionGroupsFormsTable extends Table
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

        $this->setTable('question_groups_forms');
        $this->setDisplayField('crfform_id');
        $this->setPrimaryKey(['crfform_id', 'question_id']);

        $this->belongsTo('Crfforms', [
            'foreignKey' => 'crfform_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Questions', [
            'foreignKey' => 'question_id',
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
        $rules->add($rules->existsIn(['crfform_id'], 'Crfforms'));
        $rules->add($rules->existsIn(['question_id'], 'Questions'));

        return $rules;
    }
}
