<?php
declare(strict_types=1);

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
    // phpcs:disable
    public $fields = [
        'questionID' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'description' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '(pt-br) Descrição.
(en) description.', 'precision' => null],
        'questionTypeID' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '(pt-br) Chave estrangeira para tabela tb_QuestionsTypes.
(en) Foreign key for the tp_QuestionsTypes table.', 'precision' => null, 'autoIncrement' => null],
        'listTypeID' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'questionGroupID' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'subordinateTo' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'isAbout' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'FKtb_Questio240796' => ['type' => 'index', 'columns' => ['listTypeID'], 'length' => []],
            'FKtb_Questio684913' => ['type' => 'index', 'columns' => ['questionTypeID'], 'length' => []],
            'FKtb_Questio808495' => ['type' => 'index', 'columns' => ['questionGroupID'], 'length' => []],
            'SubordinateTo' => ['type' => 'index', 'columns' => ['subordinateTo'], 'length' => []],
            'isAbout' => ['type' => 'index', 'columns' => ['isAbout'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['questionID'], 'length' => []],
            'tb_questions_ibfk_1' => ['type' => 'foreign', 'columns' => ['questionTypeID'], 'references' => ['tb_questiontype', 'questionTypeID'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'tb_questions_ibfk_2' => ['type' => 'foreign', 'columns' => ['listTypeID'], 'references' => ['tb_listofvalues', 'listTypeID'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'tb_questions_ibfk_3' => ['type' => 'foreign', 'columns' => ['questionGroupID'], 'references' => ['tb_questiongroup', 'questionGroupID'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // phpcs:enable
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'questionID' => 1,
                'description' => 'Lorem ipsum dolor sit amet',
                'questionTypeID' => 1,
                'listTypeID' => 1,
                'questionGroupID' => 1,
                'subordinateTo' => 1,
                'isAbout' => 1,
            ],
        ];
        parent::init();
    }
}
