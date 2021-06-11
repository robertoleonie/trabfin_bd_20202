<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * QuestionsFixture
 */
class QuestionsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'question_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
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
            'primary' => ['type' => 'primary', 'columns' => ['question_id'], 'length' => []],
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
                'question_id' => 1,
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
