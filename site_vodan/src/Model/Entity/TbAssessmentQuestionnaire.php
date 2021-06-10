<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TbAssessmentQuestionnaire Entity
 *
 * @property int $participant_id
 * @property int $hospital_unit_id
 * @property int $questionnaire_id
 *
 * @property \App\Model\Entity\Participant $participant
 * @property \App\Model\Entity\HospitalUnit $hospital_unit
 * @property \App\Model\Entity\Questionnaire $questionnaire
 */
class TbAssessmentQuestionnaire extends Entity
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
        'participant' => true,
        'hospital_unit' => true,
        'questionnaire' => true,
    ];
}
