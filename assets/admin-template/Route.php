<?php
/**
 * NIUCLOUD Route 路由配置模板（管理端）
 * 使用说明：复制此文件到 niucloud/addon/插件标识/app/adminapi/route/模块名.php
 */

use think\facade\Route;

/**
 * 管理端API路由组
 * 前缀：/adminapi/插件标识
 * 中间件：验证Token、验证角色、记录日志
 */
Route::group('插件标识', function () {
    
    // 获取分页列表
    Route::get('lists', '模块名Controller/lists');
    
    // 获取列表（不分页）
    Route::get('list', '模块名Controller/list');
    
    // 获取详情
    Route::get('info/<id>', '模块名Controller/info');
    
    // 添加数据
    Route::post('add', '模块名Controller/add');
    
    // 编辑数据
    Route::put('edit/<id>', '模块名Controller/edit');
    
    // 删除数据
    Route::delete('del/<id>', '模块名Controller/del');
    
    // 修改状态
    Route::put('modifyStatus', '模块名Controller/modifyStatus');
    
    // 修改排序
    Route::put('modifySort', '模块名Controller/modifySort');
    
})->middleware([
    \app\adminapi\middleware\AdminCheckToken::class,   // Token验证
    \app\adminapi\middleware\AdminCheckRole::class,    // 角色权限验证
    \app\adminapi\middleware\AdminLog::class,           // 操作日志
]);
