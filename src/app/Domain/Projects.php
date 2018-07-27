<?php
namespace App\Domain;

use App\Model\Projects as ModelProjects;

class Projects {
	
    public function getList($search, $page, $perpage) {
        $rs = array('items' => array(), 'total' => 0);

        $model = new ModelProjects();
        $items = $model->getListItems($search, $page, $perpage);
        $total = $model->getListTotal($search);

        $rs['items'] = $items;
        $rs['total'] = $total;

        return $rs;
    }
}
