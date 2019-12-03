<?php
namespace App\Domain;

use App\Model\Keyword as ModelKeyword;

class Keyword {
	
    public function getKeyword() {
        $rs = array('items' => array());

        $model = new ModelKeyword();
        $items = $model->getKeyword();

        $rs['items'] = $items;

        return $rs;
    }
}
