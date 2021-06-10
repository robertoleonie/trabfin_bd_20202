<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TbListOfValuesFixture
 */
class TbListOfValuesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'list_of_value_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'list_type_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'description' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '(pt-br) Descrição.
(en) description.', 'precision' => null, 'fixed' => null],
        '_indexes' => [
            'FKtb_ListOfV184108' => ['type' => 'index', 'columns' => ['list_type_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['list_of_value_id'], 'length' => []],
            'tb_list_of_values_ibfk_1' => ['type' => 'foreign', 'columns' => ['list_type_id'], 'references' => ['tb_list_types', 'list_type_id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
                'list_of_value_id' => 1,
                'list_type_id' => 1,
                'description' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}