<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TbQuestionGroupsFormsRecordsFixture
 */
class TbQuestionGroupsFormsRecordsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'questionGroupFormRecordID' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'form_record_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'crfform_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'question_idb' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'list_of_value_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'answer' => ['type' => 'string', 'length' => 512, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        '_indexes' => [
            'FKtb_Questio928457' => ['type' => 'index', 'columns' => ['list_of_value_id'], 'length' => []],
            'FKtb_Questio489549' => ['type' => 'index', 'columns' => ['crfform_id', 'question_idb'], 'length' => []],
            'FKtb_Questio935723' => ['type' => 'index', 'columns' => ['form_record_id'], 'length' => []],
            'question_idb' => ['type' => 'index', 'columns' => ['question_idb'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['questionGroupFormRecordID'], 'length' => []],
            'tb_question_groups_forms_records_ibfk_1' => ['type' => 'foreign', 'columns' => ['crfform_id'], 'references' => ['tb_crfforms', 'crfform_id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'tb_question_groups_forms_records_ibfk_2' => ['type' => 'foreign', 'columns' => ['question_idb'], 'references' => ['tb_questions', 'question_idb'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'tb_question_groups_forms_records_ibfk_3' => ['type' => 'foreign', 'columns' => ['list_of_value_id'], 'references' => ['tb_list_of_values', 'list_of_value_id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
                'questionGroupFormRecordID' => 1,
                'form_record_id' => 1,
                'crfform_id' => 1,
                'question_idb' => 1,
                'list_of_value_id' => 1,
                'answer' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
