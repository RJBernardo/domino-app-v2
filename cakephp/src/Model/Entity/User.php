<?php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $name
 * @property string|null $email
 * @property string|null $photo_dir
 * @property int|null $photo
 * @property string|null $active
 * @property string $removed
 * @property \Cake\I18n\FrozenDate $created
 * @property \Cake\I18n\FrozenDate $modified
 * @property string|null $password
 * @property string|null $id_jogador
 * @property int|null $group_id
 * @property int|null $role_id
 *
 * @property \App\Model\Entity\Game[] $games
 * @property \App\Model\Entity\Scoreboard[] $scoreboards
 * @property \Acl\Model\Entity\Aro[] $aro
 */
class User extends Entity
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
        'email' => true,
        'photo_dir' => true,
        'photo' => true,
        'active' => true,
        'removed' => true,
        'created' => true,
        'modified' => true,
        'password' => true,
        'id_jogador' => true,
        'group_id' => true,
        'role_id' => true,
        'games' => true,
        'scoreboards' => true,
        'aro' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];

    protected function _setPassword($password) {
        if(strlen($password) > 0){
            return (new DefaultPasswordHasher)->hash($password);
        }
    }

    public function parentNode() {
        if (!$this->id) {
            return null;
        }
        if (isset($this->role_id)) {
            $roleId = $this->role_id;
        } else {
            $Users = TableRegistry::get('Users');
            $user = $Users->find('all', ['fields' => ['role_id']])->where(['id' => $this->id])->first();
            $roleId = $user->role_id;
        }
        if (!$roleId) {
            return null;
        }
        return ['Roles' => ['id' => $roleId]];
    }
}
