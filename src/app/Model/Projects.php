<?php
namespace App\Model;

use PhalApi\Model\NotORMModel as NotORM;

class Projects extends NotORM {
	public function getListItems($search, $page, $perpage) {
        return $this->getORM()
            ->select('*')
            ->where('title = ?', $search)
            ->order('dateline DESC')
            ->limit(($page - 1) * $perpage, $perpage)
            ->fetchAll();
    }
	
	public function getListTotal($search) {
        $total = $this->getORM()
            ->where('title = ?', $search)
            ->count('id');

        return intval($total);
    }
}

