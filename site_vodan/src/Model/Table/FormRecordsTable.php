<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FormRecords Model
 *
 * @property \App\Model\Table\ParticipantsTable&\Cake\ORM\Association\BelongsTo $Participants
 * @property \App\Model\Table\HospitalUnitsTable&\Cake\ORM\Association\BelongsTo $HospitalUnits
 * @property \App\Model\Table\QuestionnairesTable&\Cake\ORM\Association\BelongsTo $Questionnaires
 * @property \App\Model\Table\CrfformsTable&\Cake\ORM\Association\BelongsTo $Crfforms
 *
 * @method \App\Model\Entity\FormRecord get($primaryKey, $options = [])
 * @method \App\Model\Entity\FormRecord newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\FormRecord[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FormRecord|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FormRecord saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FormRecord patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FormRecord[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\FormRecord findOrCreate($search, callable $callback = null, $options = [])
 */
class FormRecordsTable extends Table
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

        $this->setTable('form_records');
        $this->setDisplayField('dtRegisroForm');
        $this->setPrimaryKey('form_record_id');

        $this->belongsTo('Participants', [
            'foreignKey' => 'participant_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('HospitalUnits', [
            'foreignKey' => 'hospital_unit_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Questionnaires', [
            'foreignKey' => 'questionnaire_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Crfforms', [
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
            ->integer('form_record_id')
            ->allowEmptyString('form_record_id', null, 'create');

        $validator
            ->dateTime('dtRegistroForm')
            ->requirePresence('dtRegistroForm', 'create')
            ->notEmptyDateTime('dtRegistroForm');

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
        $rules->add($rules->existsIn(['participant_id'], 'Participants'));
        $rules->add($rules->existsIn(['hospital_unit_id'], 'HospitalUnits'));
        $rules->add($rules->existsIn(['questionnaire_id'], 'Questionnaires'));
        $rules->add($rules->existsIn(['crfform_id'], 'Crfforms'));

        return $rules;
    }
}
