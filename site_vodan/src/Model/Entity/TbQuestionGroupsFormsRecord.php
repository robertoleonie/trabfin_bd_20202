<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TbQuestionGroupsFormsRecord Entity
 *
 * @property int $questionGroupFormRecordID
 * @property int $form_record_id
 * @property int $crfform_id
 * @property int $question_idb
 * @property int|null $list_of_value_id
 * @property string|null $answer
 *
 * @property \App\Model\Entity\FormRecord $form_record
 * @property \App\Model\Entity\TbCrfform $tb_crfform
 * @property \App\Model\Entity\TbListOfValue $tb_list_of_value
 */
class TbQuestionGroupsFormsRecord extends Entity
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
        'form_record_id' => true,
        'crfform_id' => true,
        'question_idb' => true,
        'list_of_value_id' => true,
        'answer' => true,
        'form_record' => true,
        'tb_crfform' => true,
        'tb_list_of_value' => true,
    ];
}
