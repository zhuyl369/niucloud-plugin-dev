<?php
/**
 * NIUCLOUD Service 层模板（管理端）
 * 使用说明：复制此文件到 niucloud/addon/插件标识/app/service/admin/模块名Service.php
 */

namespace addon\插件标识\app\service\admin;

use core\base\BaseService;
use addon\插件标识\app\model\模块名\模型名;
use think\facade\Db;

class 模块名Service extends BaseService
{
    /**
     * 模型实例
     * @var 模型名
     */
    protected $model;

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->model = new 模型名();
        parent::__construct();
    }

    /**
     * 获取分页列表
     * 方法名：getPage
     * @param array $where 查询条件
     * @return array
     */
    public function getPage(array $where = [])
    {
        $field = 'id, 字段名, create_time';
        $order = 'id desc';
        
        $search_model = $this->model
            ->where([['site_id', '=', $this->site_id]])
            ->withSearch(["字段名"], $where)
            ->field($field)
            ->order($order);
        
        $list = $this->pageQuery($search_model);
        return $list;
    }

    /**
     * 获取列表（不分页）
     * 方法名：getList
     * @param array $where 查询条件
     * @param string $field 查询字段
     * @return array
     */
    public function getList(array $where = [], $field = 'id, 字段名')
    {
        return $this->model
            ->where([['site_id', '=', $this->site_id]])
            ->withSearch(["字段名"], $where)
            ->field($field)
            ->order('id desc')
            ->select()
            ->toArray();
    }

    /**
     * 获取详情信息
     * 方法名：getInfo
     * @param int $id 主键ID
     * @return array
     */
    public function getInfo(int $id)
    {
        return $this->model
            ->field('id, 字段名, create_time')
            ->where([['id', '=', $id], ['site_id', '=', $this->site_id]])
            ->findOrEmpty()
            ->toArray();
    }

    /**
     * 获取关联表详情
     * 方法名：getDetail
     * @param int $id 主键ID
     * @return array
     */
    public function getDetail(int $id)
    {
        return $this->model
            ->with(['relationModel'])  // 关联模型
            ->where([['id', '=', $id], ['site_id', '=', $this->site_id]])
            ->findOrEmpty()
            ->toArray();
    }

    /**
     * 添加数据
     * 方法名：add
     * @param array $data 添加数据
     * @return int
     */
    public function add(array $data)
    {
        $data['create_time'] = time();
        $data['site_id'] = $this->site_id;
        
        $res = $this->model->create($data);
        return $res->id;
    }

    /**
     * 编辑数据
     * 方法名：edit
     * @param int $id 主键ID
     * @param array $data 编辑数据
     * @return bool
     */
    public function edit(int $id, array $data)
    {
        $data['update_time'] = time();
        
        $this->model
            ->where([['id', '=', $id], ['site_id', '=', $this->site_id]])
            ->update($data);
        
        return true;
    }

    /**
     * 删除数据（软删除）
     * 方法名：del
     * @param int $id 主键ID
     * @return bool
     */
    public function del(int $id)
    {
        $model = $this->model
            ->where([['id', '=', $id], ['site_id', '=', $this->site_id]])
            ->find();
        
        return $model->delete();
    }

    /**
     * 修改状态
     * 方法名：modifyStatus
     * @param array $data 数据包含 id 和 status
     * @return bool
     */
    public function modifyStatus($data)
    {
        return $this->model
            ->where([['id', '=', $data['id']], ['site_id', '=', $this->site_id]])
            ->update(['status' => $data['status']]);
    }

    /**
     * 修改排序
     * 方法名：modifySort
     * @param array $data 数据包含 id 和 sort
     * @return bool
     */
    public function modifySort($data)
    {
        return $this->model
            ->where([['id', '=', $data['id']], ['site_id', '=', $this->site_id]])
            ->update(['sort' => $data['sort']]);
    }
}
