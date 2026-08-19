/**
 * NIUCLOUD Admin 管理端 API 接口定义模板
 * 使用说明：复制此文件到 admin/api/插件标识/模块名.js
 */

import request from '@/utils/request'

/**
 * 获取分页列表
 * @param {Object} data - 查询参数
 * @param {number} data.page - 页码
 * @param {number} data.limit - 每页数量
 * @param {string} data.字段名 - 其他查询条件
 * @returns {Promise}
 */
export function getPage(data: any) {
    return request.post('/adminapi/插件标识/lists', data)
}

/**
 * 获取列表（不分页）
 * @param {Object} params - 查询参数
 * @returns {Promise}
 */
export function getList(params: any = {}) {
    return request.get('/adminapi/插件标识/list', { params })
}

/**
 * 获取详情
 * @param {number} id - 记录ID
 * @returns {Promise}
 */
export function getInfo(id: number) {
    return request.get(`/adminapi/插件标识/info/${id}`)
}

/**
 * 添加数据
 * @param {Object} data - 数据对象
 * @returns {Promise}
 */
export function add(data: any) {
    return request.post('/adminapi/插件标识/add', data)
}

/**
 * 编辑数据
 * @param {number} id - 记录ID
 * @param {Object} data - 数据对象
 * @returns {Promise}
 */
export function edit(id: number, data: any) {
    return request.put(`/adminapi/插件标识/edit/${id}`, data)
}

/**
 * 删除数据
 * @param {number} id - 记录ID
 * @returns {Promise}
 */
export function del(id: number) {
    return request.delete(`/adminapi/插件标识/del/${id}`)
}

/**
 * 修改状态
 * @param {Object} data - 数据和状态
 * @returns {Promise}
 */
export function modifyStatus(data: any) {
    return request.put('/adminapi/插件标识/modifyStatus', data)
}

/**
 * 修改排序
 * @param {Object} data - 数据和排序值
 * @returns {Promise}
 */
export function modifySort(data: any) {
    return request.put('/adminapi/插件标识/modifySort', data)
}
