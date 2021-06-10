<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TbQuestionGroupsFormsFixture
 */
class TbQuestionGroupsFormsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'crfform_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'question_idb' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'questionOrder' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'FKtb_Questio124287' => ['type' => 'index', 'columns' => ['question_idb'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['crfform_id', 'question_idb'], 'length' => []],
            'tb_question_groups_forms_ibfk_1' => ['type' => 'foreign', 'columns' => ['crfform_id'], 'references' => ['tb_crfforms', 'crfform_id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'tb_question_groups_forms_ibfk_2' => ['type' => 'foreign', 'columns' => ['question_idb'], 'references' => ['tb_questions', 'question_idb'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
                'crfform_id' => 1,
                'question_idb' => 1,
                'questionOrder' => 1,
            ],
        ];
        parent::init();
    }
}
