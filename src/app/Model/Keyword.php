<?php
namespace App\Model;

use PhalApi\Model\NotORMModel as NotORM;

class Keyword extends NotORM {
	public function getKeyword() {
            return $this->getORM()
            ->select('*')
            ->fetchAll();
    }
}

