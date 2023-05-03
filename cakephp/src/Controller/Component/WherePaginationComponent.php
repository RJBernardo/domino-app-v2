<?php
/**
 * Created by PhpStorm.
 * User: edson
 * Date: 03/06/2016
 * Time: 17:10
 */

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\I18n\Time;

class WherePaginationComponent extends Component
{
    /**
     * @param array $data
     * @param  $alias
     * @return array
     */
    public function conditions(array $data, $alias=null)
    {
        $conditions = [];
        foreach ($data as $index => $item) {
            if (!empty($item)) {
                if (false === strripos($index, '_id') && false === strripos($index, 'id')) {
                    if (false !== strripos($index, 'date')) {
                        $conditions[$alias.'.'.$index . ' LIKE'] = '%' . Time::parse($item)->i18nFormat('yyyy-MM-dd') . '%';
                    } else {
                        $conditions[$alias.'.'.$index . ' LIKE'] = '%' . $item . '%';
                    }
                } else {
                    $conditions[$alias.'.'.$index . ' ='] = $item;
                }
            }
        }
        return $conditions;
    }
}