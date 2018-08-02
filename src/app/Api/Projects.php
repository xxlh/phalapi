<?php
namespace App\Api;

use PhalApi\Api;
use App\Domain\Projects as DomainProjects;

/**
 * 默认接口服务类
 *
 * @author: dogstar <chanzonghuang@gmail.com> 2014-10-04
 */


class Projects extends Api {

	public function getRules() {
        return array(
            'getList' => array(
                'page' => array('name' => 'page', 'type' => 'int', 'min' => 1, 'default' => 1, 'desc' => '第几页'),
                'perpage' => array('name' => 'perpage', 'type' => 'int', 'min' => 1, 'max' => 20, 'default' => 10, 'desc' => '分页数量'),
                'search' => array('name' => 'search', 'type' => 'string', 'default' => '', 'desc' => '模糊查询字段'),
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
    public function getList() {
        $rs = array();

        $domainProjects = new DomainProjects();
        $list = $domainProjects->getList($this->search, $this->page, $this->perpage);

        $rs['items'] = $list['items'];
        $rs['total'] = $list['total'];
        $rs['page'] = $this->page;
        $rs['perpage'] = $this->perpage;

        return $rs;
    }
}
