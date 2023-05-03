<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Test Entity
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property int|null $active
 * @property \Cake\I18n\FrozenDate|null $date
 * @property \Cake\I18n\FrozenTime|null $created
 * @property string|null $tipo
 */
class Test extends Entity
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
        'name' => true,
        'description' => true,
        'active' => true,
        'date' => true,
        'created' => true,
        'tipo' => true
    ];
}
