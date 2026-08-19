<?php
/**
 * NIUCLOUD Model 层模板
 * 使用说明：复制此文件到 niucloud/addon/插件标识/app/model/模块名/模型名.php
 */

namespace addon\插件标识\app\model\模块名;

use core\base\BaseModel;
use think\model\concern\SoftDelete;

class 模型名 extends BaseModel
{
    use SoftDelete;

    /**
     * 数据表主键
     * @var string
     */
    protected $pk = 'id';

    /**
     * 模型名称（对应数据表名，不含前缀）
     * @var string
     */
    protected $name = '表名';

    /**
     * 类型转换
     * @var array
     */
    protected $type = [
        'id' => 'integer',
        'create_time' => 'timestamp:Y-m-d H:i:s',
        'update_time' => 'timestamp:Y-m-d H:i:s',
        // '字段名' => '数据类型',
    ];

    /**
     * 软删除字段
     * @var string
     */
    protected $deleteTime = 'delete_time';

    /**
     * 软删除默认值
     * @var int
     */
    protected $defaultSoftDelete = 0;

    /**
     * JSON字段设置
     * @var array
     */
    protected $json = ['extend_info'];

    /**
     * JSON数据返回数组
     * @var bool
     */
    protected $jsonAssoc = true;

    /**
     * 获取器：处理字段显示
     * @param $value
     * @return mixed
     */
    public function getStatusNameAttr($value, $data)
    {
        $status = [1 => '启用', 0 => '禁用'];
        return $status[$data['status']] ?? '未知';
    }

    /**
     * 搜索器：字段名搜索
     * @param $query
     * @param $value
     */
    public function search字段名Attr($query, $value)
    {
        if ($value) {
            $query->whereLike('字段名', "%{$value}%");
        }
    }

    /**
     * 模型关联：关联其他模型
     */
    public function relationModel()
    {
        return $this->belongsTo('关联模型', '外键', '主键');
    }
}
