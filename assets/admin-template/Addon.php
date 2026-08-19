<?php
/**
 * NIUCLOUD Addon.php 插件主文件模板
 * 使用说明：复制此文件到 niucloud/addon/插件标识/Addon.php
 */

namespace addon\插件标识\app;

class Addon
{
    /**
     * 插件安装执行
     * 在插件安装时自动调用
     * @return bool
     */
    public function install()
    {
        // TODO: 安装时的初始化操作
        // 例如：创建必要的数据记录、初始化配置等
        
        return true;
    }

    /**
     * 插件卸载执行
     * 在插件卸载时自动调用
     * 注意：默认不会删除数据表，需在此方法中处理
     * @return bool
     */
    public function uninstall()
    {
        // TODO: 卸载时的清理操作
        // 注意：如果需要删除数据表，需在此方法中执行 SQL
        // 建议：保留数据表，仅清理缓存和配置
        
        return true;
    }

    /**
     * 插件升级执行
     * 在插件升级时自动调用
     * @return bool
     */
    public function upgrade()
    {
        // TODO: 插件版本升级时的数据迁移等操作
        // 例如：新增字段、修改表结构、数据迁移等
        
        return true;
    }
}
