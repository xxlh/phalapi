<?php
namespace App\Api;

use PhalApi\Api;
use App\Domain\Keyword as DomainKeyword;

/**
 * 默认接口服务类
 *
 * @author: dogstar <chanzonghuang@gmail.com> 2014-10-04
 */


class Keyword extends Api {

	public function getRules() {
        return array(
            'getKeyword' => array(
            ),
        );
	}
	
	   /**
     * 获取分页列表数据
     * @desc 根据状态筛选列表数据，支持分页
     * @return array    items   列表数据
     * @return int      total   总数量
     * @return int      page    当前第几页
     * @return int      perpage 每页数量
     */
    public function getKeyword() {
        $rs = array();

        $domainKeyword = new DomainKeyword();
        $list = $domainKeyword->getKeyword();

        $rs['items'] = $list['items'];

        return $rs;
    }
}
