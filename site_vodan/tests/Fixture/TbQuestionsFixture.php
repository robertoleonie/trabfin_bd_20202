<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TbQuestionsFixture
 */
class TbQuestionsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'question_idb' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'description' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '(pt-br) Descrição.
(en) description.', 'precision' => null, 'fixed' => null],
        'question_type_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '(pt-br) Chave estrangeira para tabela tb_QuestionsTypes.
(en) Foreign key for the tp_QuestionsTypes table.', 'precision' => null, 'autoIncrement' => null],
        'list_type_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'question_group_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'subordinateTo' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'isAbout' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'FKtb_Questio240796' => ['type' => 'index', 'columns' => ['list_type_id'], 'length' => []],
            'FKtb_Questio684913' => ['type' => 'index', 'columns' => ['question_type_id'], 'length' => []],
            'FKtb_Questio808495' => ['type' => 'index', 'columns' => ['question_group_id'], 'length' => []],
            'SubordinateTo' => ['type' => 'index', 'columns' => ['subordinateTo'], 'length' => []],
            'isAbout' => ['type' => 'index', 'columns' => ['isAbout'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['question_idb'], 'length' => []],
            'tb_questions_ibfk_1' => ['type' => 'foreign', 'columns' => ['question_type_id'], 'references' => ['tb_question_types', 'question_type_id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'tb_questions_ibfk_2' => ['type' => 'foreign', 'columns' => ['list_type_id'], 'references' => ['tb_list_of_values', 'list_type_id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'tb_questions_ibfk_3' => ['type' => 'foreign', 'columns' => ['question_group_id'], 'references' => ['tb_question_groups', 'question_group_id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
                'question_idb' => 1,
                'description' => 'Lorem ipsum dolor sit amet',
                'question_type_id' => 1,
                'list_type_id' => 1,
                'question_group_id' => 1,
                'subordinateTo' => 1,
                'isAbout' => 1,
            ],
        ];
        parent::init();
    }
}
