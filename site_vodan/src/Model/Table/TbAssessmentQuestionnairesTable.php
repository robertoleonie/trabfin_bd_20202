<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TbAssessmentQuestionnaires Model
 *
 * @property \App\Model\Table\ParticipantsTable&\Cake\ORM\Association\BelongsTo $Participants
 * @property \App\Model\Table\HospitalUnitsTable&\Cake\ORM\Association\BelongsTo $HospitalUnits
 * @property \App\Model\Table\QuestionnairesTable&\Cake\ORM\Association\BelongsTo $Questionnaires
 *
 * @method \App\Model\Entity\TbAssessmentQuestionnaire get($primaryKey, $options = [])
 * @method \App\Model\Entity\TbAssessmentQuestionnaire newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TbAssessmentQuestionnaire[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TbAssessmentQuestionnaire|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TbAssessmentQuestionnaire saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TbAssessmentQuestionnaire patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TbAssessmentQuestionnaire[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TbAssessmentQuestionnaire findOrCreate($search, callable $callback = null, $options = [])
 */
class TbAssessmentQuestionnairesTable extends Table
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

        $this->setTable('tb_assessment_questionnaires');
        $this->setDisplayField('participant_id');
        $this->setPrimaryKey(['participant_id', 'hospital_unit_id', 'questionnaire_id']);

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

        return $rules;
    }
}
