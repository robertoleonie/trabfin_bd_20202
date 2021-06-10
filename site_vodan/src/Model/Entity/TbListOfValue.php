<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TbListOfValue Entity
 *
 * @property int $list_of_value_id
 * @property int $list_type_id
 * @property string $description
 *
 * @property \App\Model\Entity\ListType $list_type
 */
class TbListOfValue extends Entity
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
        'list_type_id' => true,
        'description' => true,
        'list_type' => true,
    ];
}
