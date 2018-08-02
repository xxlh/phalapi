<?php
namespace App\Model;

use PhalApi\Model\NotORMModel as NotORM;

class Projects extends NotORM {


	public function getListItems($search, $page, $perpage) {
        if($search==''){
            return $this->getORM()
            ->select('*')
            ->order('dateline DESC')
            ->limit(($page - 1) * $perpage, $perpage)
            ->fetchAll();
        }else{
            return $this->getORM()
            ->select('*')
            ->where('tag like ?',  '%'.$search.'%')
            ->order('dateline DESC')
            ->limit(($page - 1) * $perpage, $perpage)
            ->fetchAll();
        }
        
    }
    
    
	public function getListTotal($search) {
        if($search==''){
            $total = $this->getORM()
            ->count('id');
        }else{
            $total = $this->getORM()
            ->where('tag like ?', '%'.$search.'%' )
            ->count('id');
        }
        

        return intval($total);
    }
}

