<?php
/**
 * NIUCLOUD Controller 层模板（管理端）
 * 使用说明：复制此文件到 niucloud/addon/插件标识/app/adminapi/controller/模块名Controller.php
 */

namespace addon\插件标识\app\adminapi\controller;

use core\base\BaseAdminController;
use addon\插件标识\app\service\admin\模块名Service;

class 模块名Controller extends BaseAdminController
{
    /**
     * 获取分页列表
     * 路由：GET /adminapi/插件标识/lists
     */
    public function lists()
    {
        $data = $this->request->params([
            ['字段名', ''],
            ['page', 1],
            ['limit', 10],
        ]);
        
        return success((new 模块名Service())->getPage($data));
    }

    /**
     * 获取列表（不分页）
     * 路由：GET /adminapi/插件标识/list
     */
    public function list()
    {
        $data = $this->request->params([
            ['字段名', ''],
        ]);
        
        return success((new 模块名Service())->getList($data));
    }

    /**
     * 获取详情
     * 路由：GET /adminapi/插件标识/info/:id
     */
    public function info(int $id)
    {
        return success((new 模块名Service())->getInfo($id));
    }

    /**
     * 添加数据
     * 路由：POST /adminapi/插件标识/add
     */
    public function add()
    {
        $data = $this->request->params([
            ['字段名', ''],
        ]);
        
        $id = (new 模块名Service())->add($data);
        return success('添加成功', ['id' => $id]);
    }

    /**
     * 编辑数据
     * 路由：PUT /adminapi/插件标识/edit/:id
     */
    public function edit(int $id)
    {
        $data = $this->request->params([
            ['字段名', ''],
        ]);
        
        (new 模块名Service())->edit($id, $data);
        return success('编辑成功');
    }

    /**
     * 删除数据
     * 路由：DELETE /adminapi/插件标识/del/:id
     */
    public function del(int $id)
    {
        (new 模块名Service())->del($id);
        return success('删除成功');
    }

    /**
     * 修改状态
     * 路由：PUT /adminapi/插件标识/modifyStatus
     */
    public function modifyStatus()
    {
        $data = $this->request->params([
            ['id', 0],
            ['status', 0],
        ]);
        
        (new 模块名Service())->modifyStatus($data);
        return success('修改成功');
    }

    /**
     * 修改排序
     * 路由：PUT /adminapi/插件标识/modifySort
     */
    public function modifySort()
    {
        $data = $this->request->params([
            ['id', 0],
            ['sort', 0],
        ]);
        
        (new 模块名Service())->modifySort($data);
        return success('修改成功');
    }
}
