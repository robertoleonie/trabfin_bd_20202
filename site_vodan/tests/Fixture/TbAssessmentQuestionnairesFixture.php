<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TbAssessmentQuestionnairesFixture
 */
class TbAssessmentQuestionnairesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'participant_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '(pt-br)  Chave estrangeira para a tabela tb_Patient.
(en) Foreign key to the tb_Patient table.', 'precision' => null, 'autoIncrement' => null],
        'hospital_unit_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '(pt-br) Chave estrangeira para tabela tb_HospitalUnit.
(en) Foreign key for the tp_HospitalUnit table.', 'precision' => null, 'autoIncrement' => null],
        'questionnaire_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'FKtb_Assessm665217' => ['type' => 'index', 'columns' => ['hospital_unit_id'], 'length' => []],
            'FKtb_Assessm419169' => ['type' => 'index', 'columns' => ['questionnaire_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['participant_id', 'hospital_unit_id', 'questionnaire_id'], 'length' => []],
            'tb_assessment_questionnaires_ibfk_1' => ['type' => 'foreign', 'columns' => ['participant_id'], 'references' => ['tb_participants', 'participant_id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'tb_assessment_questionnaires_ibfk_2' => ['type' => 'foreign', 'columns' => ['hospital_unit_id'], 'references' => ['tb_hospital_units', 'hospital_unit_id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'tb_assessment_questionnaires_ibfk_3' => ['type' => 'foreign', 'columns' => ['questionnaire_id'], 'references' => ['tb_questionnaires', 'questionnaire_id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd
    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'participant_id' => 1,
                'hospital_unit_id' => 1,
                'questionnaire_id' => 1,
            ],
        ];
        parent::init();
    }
}
