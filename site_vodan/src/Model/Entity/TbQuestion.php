<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TbQuestion Entity
 *
 * @property int $question_idb
 * @property string $description
 * @property int $question_type_id
 * @property int|null $list_type_id
 * @property int|null $question_group_id
 * @property int|null $subordinateTo
 * @property int|null $isAbout
 *
 * @property \App\Model\Entity\TbQuestionType $tb_question_type
 * @property \App\Model\Entity\TbListOfValue $tb_list_of_value
 * @property \App\Model\Entity\TbQuestionGroup $tb_question_group
 */
class TbQuestion extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'description' => true,
        'question_type_id' => true,
        'list_type_id' => true,
        'question_group_id' => true,
        'subordinateTo' => true,
        'isAbout' => true,
        'tb_question_type' => true,
        'tb_list_of_value' => true,
        'tb_question_group' => true,
    ];
}
