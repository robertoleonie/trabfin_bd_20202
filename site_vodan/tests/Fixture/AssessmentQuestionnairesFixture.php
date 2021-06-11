<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AssessmentQuestionnairesFixture
 */
class AssessmentQuestionnairesFixture extends TestFixture
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
        ],
        '_options' => [
            'engine' => 'MyISAM',
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
