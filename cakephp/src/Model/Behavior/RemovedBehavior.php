<?php
/**
 * Created by PhpStorm.
 * User: Rodol
 * Date: 04/07/2018
 * Time: 00:10
 */

namespace App\Model\Behavior;


use Cake\ORM\Behavior;

class RemovedBehavior extends Behavior
{
    public function beforeFind($event, $query)
    {
        $alias = $event->subject()->alias();
        $query->where([$alias.'.removed' => 'N']);
    }
}