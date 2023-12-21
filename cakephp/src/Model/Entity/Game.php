<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Game Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenDate $data
 * @property int $game
 * @property int $user_id
 * @property bool|null $win
 * @property string $type_game
 * @property int $qtd_games
 * @property string|null $type_win_first
 * @property string|null $type_win_second
 * @property \Cake\I18n\FrozenDate|null $created
 * @property \Cake\I18n\FrozenDate|null $modified
 * @property int|null $created_by
 * @property double|null $value
 *
 * @property \App\Model\Entity\User $user
 */
class Game extends Entity
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
        'data' => true,
        'game' => true,
        'user_id' => true,
        'win' => true,
        'type_game' => true,
        'qtd_games' => true,
        'type_win_first' => true,
        'type_win_second' => true,
        'created' => true,
        'modified' => true,
        'created_by' => true,
        'user' => true,
        'cheat' => true,
        'week' => true,
        'year' => true,
        'month' => true,
        'qtd_win' => true,
        'value' => true
    ];
}
