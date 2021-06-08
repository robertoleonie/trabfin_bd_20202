<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TbQuestiongroupformrecordFixture
 */
class TbQuestiongroupformrecordFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'tb_questiongroupformrecord';
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'questionGroupFormRecordID' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'formRecordID' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'crfFormsID' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'questionID' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'listOfValuesID' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'answer' => ['type' => 'string', 'length' => 512, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null],
        '_indexes' => [
            'FKtb_Questio928457' => ['type' => 'index', 'columns' => ['listOfValuesID'], 'length' => []],
            'FKtb_Questio489549' => ['type' => 'index', 'columns' => ['crfFormsID', 'questionID'], 'length' => []],
            'FKtb_Questio935723' => ['type' => 'index', 'columns' => ['formRecordID'], 'length' => []],
            'questionID' => ['type' => 'index', 'columns' => ['questionID'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['questionGroupFormRecordID'], 'length' => []],
            'tb_questiongroupformrecord_ibfk_1' => ['type' => 'foreign', 'columns' => ['crfFormsID'], 'references' => ['tb_crfforms', 'crfFormsID'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'tb_questiongroupformrecord_ibfk_2' => ['type' => 'foreign', 'columns' => ['questionID'], 'references' => ['tb_questions', 'questionID'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'tb_questiongroupformrecord_ibfk_3' => ['type' => 'foreign', 'columns' => ['listOfValuesID'], 'references' => ['tb_listofvalues', 'listOfValuesID'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
                'questionGroupFormRecordID' => 1,
                'formRecordID' => 1,
                'crfFormsID' => 1,
                'questionID' => 1,
                'listOfValuesID' => 1,
                'answer' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
