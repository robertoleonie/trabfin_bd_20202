<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * FormRecord Entity
 *
 * @property int $form_record_id
 * @property int $participant_id
 * @property int $hospital_unit_id
 * @property int $questionnaire_id
 * @property int $crfform_id
 * @property \Cake\I18n\FrozenTime $dtRegistroForm
 *
 * @property \App\Model\Entity\Participant $participant
 * @property \App\Model\Entity\HospitalUnit $hospital_unit
 * @property \App\Model\Entity\Questionnaire $questionnaire
 * @property \App\Model\Entity\Crfform $crfform
 */
class FormRecord extends Entity
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
        'participant_id' => true,
        'hospital_unit_id' => true,
        'questionnaire_id' => true,
        'crfform_id' => true,
        'dtRegistroForm' => true,
        'participant' => true,
        'hospital_unit' => true,
        'questionnaire' => true,
        'crfform' => true,
    ];
}
