<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TbQuestionGroupsFormsRecords Model
 *
 * @property \App\Model\Table\FormRecordsTable&\Cake\ORM\Association\BelongsTo $FormRecords
 * @property \App\Model\Table\TbCrfformsTable&\Cake\ORM\Association\BelongsTo $TbCrfforms
 * @property \App\Model\Table\TbListOfValuesTable&\Cake\ORM\Association\BelongsTo $TbListOfValues
 *
 * @method \App\Model\Entity\TbQuestionGroupsFormsRecord get($primaryKey, $options = [])
 * @method \App\Model\Entity\TbQuestionGroupsFormsRecord newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TbQuestionGroupsFormsRecord[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TbQuestionGroupsFormsRecord|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TbQuestionGroupsFormsRecord saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TbQuestionGroupsFormsRecord patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TbQuestionGroupsFormsRecord[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TbQuestionGroupsFormsRecord findOrCreate($search, callable $callback = null, $options = [])
 */
class TbQuestionGroupsFormsRecordsTable extends Table
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

        $this->setTable('tb_question_groups_forms_records');
        $this->setDisplayField('questionGroupFormRecordID');
        $this->setPrimaryKey('questionGroupFormRecordID');

        $this->belongsTo('FormRecords', [
            'foreignKey' => 'form_record_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('TbCrfforms', [
            'foreignKey' => 'crfform_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('TbListOfValues', [
            'foreignKey' => 'list_of_value_id',
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
            ->integer('questionGroupFormRecordID')
            ->allowEmptyString('questionGroupFormRecordID', null, 'create');

        $validator
            ->integer('question_idb')
            ->requirePresence('question_idb', 'create')
            ->notEmptyString('question_idb');

        $validator
            ->scalar('answer')
            ->maxLength('answer', 512)
            ->allowEmptyString('answer');

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
        $rules->add($rules->existsIn(['form_record_id'], 'FormRecords'));
        $rules->add($rules->existsIn(['crfform_id'], 'TbCrfforms'));
        $rules->add($rules->existsIn(['list_of_value_id'], 'TbListOfValues'));

        return $rules;
    }
}
