---
name: niucloud-plugin-dev
description: NIUCLOUD-ADMIN SaaS 插件开发 Skill。当用户需要创建、开发 niucloud admin saas
  插件时触发，包括前后端代码开发、菜单开发、DIY页面装修开发等。触发词：创建niucloud插件、开发niucloud插件、niucloud插件开发、生成niucloud插件、niucloud
  saas插件、开发niucloud
  admin插件、创建插件菜单、开发DIY页面、niucloud菜单开发、niucloud前端开发、niucloud后端开发。
---

# NIUCLOUD-ADMIN SaaS 插件开发 Skill

本 Skill 提供 niucloud admin saas 框架的插件开发全流程指导，包括插件创建、前后端代码开发、菜单配置、DIY页面装修等完整功能。

## 技术栈

### 后端技术栈
- **框架**: ThinkPHP (PHP)
- **数据库**: MySQL + Redis (缓存)
- **依赖管理**: Composer
- **编程风格**: RESTful API

### 前端技术栈

#### Admin 管理端
- **框架**: Vue3 + Vite + TypeScript
- **路由**: Vue Router
- **状态管理**: Pinia
- **UI组件库**: Element Plus
- **CSS**: Tailwind CSS + Sass
- **HTTP客户端**: Axios
- **国际化**: Vue I18n
- **图表**: ECharts
- **富文本**: wangEditor
- **工具库**: vueuse

#### uni-app 手机端
- **框架**: Uni-app + Vite + TypeScript
- **CSS**: Windi CSS
- **UI组件库**: uview-plus

#### Web 端
- **框架**: Nuxt.js + Vue3 + Vite
- **UI组件库**: Element Plus
- **状态管理**: Pinia
- **国际化**: Vue I18n

## 插件目录结构

插件位于 `niucloud/addon/插件名称/` 目录下：

```
niucloud/addon/插件名称/
├─ admin/                      # 管理端前端目录
│   ├─ api/                    # 管理端API接口定义
│   ├─ assets/                 # 静态资源文件
│   ├─ lang/                   # 前端语言包
│   ├─ layout/                 # 布局组件
│   └─ views/                  # 页面视图
├─ app/                        # 后端业务代码
│   ├─ adminapi/               # 管理端API
│   │   ├─ controller/        # 控制器层
│   │   └─ route/             # 路由配置
│   ├─ api/                    # 前端API（移动端/web端共用）
│   │   ├─ controller/        # 控制器层
│   │   └─ route/             # 路由配置
│   ├─ dict/                   # 字典定义（菜单等）
│   │   └─ menu/              # 菜单配置
│   ├─ job/                    # 定时任务
│   ├─ lang/                   # 后端语言包
│   ├─ listener/               # 事件监听器
│   ├─ model/                  # 数据模型
│   ├─ service/                # 业务服务层
│   │   ├─ admin/             # 管理端服务
│   │   ├─ api/               # 前端服务
│   │   └─ core/              # 核心服务
│   ├─ upgrade/                # 升级脚本
│   ├─ validate/               # 验证规则
│   └─ event.php               # 事件定义
├─ compile/                     # 编译目录
├─ package/                     # 依赖包配置
│   ├─ admin-package.json      # admin端依赖
│   ├─ composer.json           # 主应用依赖
│   ├─ uni-app-package.json    # uni-app端依赖
│   └─ web-package.json        # web前端依赖
├─ resource/                    # 插件资源文件
├─ sql/                         # SQL文件
│   ├─ install.sql             # 安装时执行
│   └─ unInstall.sql           # 卸载时执行
├─ uni-app/                     # 移动端前端目录
│   ├─ api/                    # 移动端API接口定义
│   ├─ components/             # 公共组件
│   ├─ hooks/                  # 钩子组件
│   ├─ locale/                 # 语言包
│   ├─ pages/                  # 页面视图
│   ├─ static/                 # 静态资源
│   ├─ stores/                 # 状态管理
│   ├─ styles/                 # 样式表
│   └─ utils/                  # 工具函数
├─ web/                         # web前端目录
│   ├─ api/                    # web端API接口定义
│   ├─ assets/                 # 静态资源文件
│   ├─ lang/                   # 语言包
│   └─ pages/                  # 页面视图
├─ Addon.php                    # 插件主文件（安装/卸载/升级）
└─ info.json                    # 插件配置文件
```

## 执行流程

当用户请求创建 niucloud 插件时，按以下步骤执行：

### 1. 收集插件信息

向用户确认以下信息（如未提供）：
- **插件名称**（英文标识，如 `hello_world`）
- **插件中文名称**（如 `Hello World`）
- **插件描述**
- **插件类型**（`app` 应用 或 `addon` 插件）
- **需要开发的功能模块**

### 2. 创建插件基础结构

生成以下核心文件：

#### info.json - 插件配置
```json
{
  "title": "插件中文名",
  "desc": "插件描述",
  "key": "插件英文标识",
  "version": "1.0.0",
  "author": "开发者名称",
  "type": "addon",
  "support_app": "",
  "compile": [],
  "support_version": "1.1.7"
}
```

#### Addon.php - 插件主文件
```php
<?php
namespace addon\插件标识\app;

class Addon
{
    /**
     * 插件安装执行
     */
    public function install()
    {
        // 安装逻辑
        return true;
    }

    /**
     * 插件卸载执行
     */
    public function uninstall()
    {
        // 卸载逻辑
        return true;
    }

    /**
     * 插件升级执行
     */
    public function upgrade()
    {
        // 升级逻辑
        return true;
    }
}
```

### 3. 数据库设计

根据功能需求设计数据表，生成 `install.sql`：

```sql
CREATE TABLE IF NOT EXISTS `{{prefix}}表名` (
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `site_id` int NOT NULL DEFAULT 0,
    `字段名` varchar(255) NOT NULL DEFAULT '' COMMENT '字段注释',
    `create_time` int NOT NULL DEFAULT 0,
    `update_time` int NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='表注释';
```

### 4. 后端开发

#### Model 层开发

创建 `app/model/模块名/模型名.php`：

```php
<?php
namespace addon\插件标识\app\model\模块名;

use core\base\BaseModel;
use think\model\concern\SoftDelete;

class 模型名 extends BaseModel
{
    use SoftDelete;

    protected $pk = '主键字段';
    protected $name = '表名';
    
    // 类型转换
    protected $type = [
        'id' => 'integer',
        'create_time' => 'timestamp',
    ];
    
    // 软删除
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = 0;
    
    // JSON字段
    protected $json = ['extend_info'];
    protected $jsonAssoc = true;
}
```

#### Service 层开发

创建 `app/service/admin/模块名Service.php`：

```php
<?php
namespace addon\插件标识\app\service\admin;

use core\base\BaseService;
use addon\插件标识\app\model\模块名\模型名;

class 模块名Service extends BaseService
{
    protected $model;

    public function __construct()
    {
        $this->model = new 模型名();
        parent::__construct();
    }

    /**
     * 获取分页列表 - getPage
     */
    public function getPage(array $where = [])
    {
        $field = 'id,字段名,create_time';
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
     * 获取列表 - getList
     */
    public function getList(array $where = [], $field = 'id,字段名')
    {
        return $this->model
            ->where([['site_id', '=', $this->site_id]])
            ->withSearch(["字段名"], $where)
            ->field($field)
            ->order('create_time desc')
            ->select()
            ->toArray();
    }

    /**
     * 获取信息 - getInfo
     */
    public function getInfo(int $id)
    {
        return $this->model
            ->field('id,字段名,create_time')
            ->where([['id', '=', $id], ['site_id', '=', $this->site_id]])
            ->findOrEmpty()
            ->toArray();
    }

    /**
     * 添加数据 - add
     */
    public function add(array $data)
    {
        $data['create_time'] = time();
        $data['site_id'] = $this->site_id;
        $res = $this->model->create($data);
        return $res->id;
    }

    /**
     * 编辑数据 - edit
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
     * 删除数据 - del
     */
    public function del(int $id)
    {
        $model = $this->model
            ->where([['id', '=', $id], ['site_id', '=', $this->site_id]])
            ->find();
        return $model->delete();
    }

    /**
     * 修改字段 - modify字段名
     */
    public function modifySort($data)
    {
        return $this->model
            ->where([['id', '=', $data['id']], ['site_id', '=', $this->site_id]])
            ->update(['sort' => $data['sort']]);
    }
}
```

#### Controller 层开发

创建 `app/adminapi/controller/模块名Controller.php`：

```php
<?php
namespace addon\插件标识\app\adminapi\controller;

use core\base\BaseAdminController;
use addon\插件标识\app\service\admin\模块名Service;

class 模块名Controller extends BaseAdminController
{
    /**
     * 列表
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
     * 详情
     */
    public function info(int $id)
    {
        return success((new 模块名Service())->getInfo($id));
    }

    /**
     * 添加
     */
    public function add()
    {
        $data = $this->request->params([
            ['字段名', ''],
        ]);
        (new 模块名Service())->add($data);
        return success('添加成功');
    }

    /**
     * 编辑
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
     * 删除
     */
    public function del(int $id)
    {
        (new 模块名Service())->del($id);
        return success('删除成功');
    }
}
```

#### Route 路由配置

创建 `app/adminapi/route/模块名.php`：

```php
<?php
use think\facade\Route;

Route::group('插件标识', function () {
    // 列表
    Route::get('lists', '模块名Controller/lists');
    // 详情
    Route::get('info/<id>', '模块名Controller/info');
    // 添加
    Route::post('add', '模块名Controller/add');
    // 编辑
    Route::put('edit/<id>', '模块名Controller/edit');
    // 删除
    Route::delete('del/<id>', '模块名Controller/del');
})->middleware([
    \app\adminapi\middleware\AdminCheckToken::class,
    \app\adminapi\middleware\AdminCheckRole::class,
    \app\adminapi\middleware\AdminLog::class,
]);
```

### 5. 菜单开发

创建 `app/dict/menu/admin.php`（平台端）或 `app/dict/menu/site.php`（站点端）：

```php
<?php
return [
    [
        'menu_name' => '插件管理',
        'menu_key' => '插件标识',
        'menu_short_name' => '插件',
        'parent_key' => '',
        'parent_select_key' => '',
        'menu_type' => 0,  // 0=目录, 1=菜单页面, 2=操作按钮
        'icon' => 'iconfont iconyingyongshichang',
        'api_url' => '',
        'router_path' => '',
        'view_path' => '',
        'methods' => '',
        'sort' => 100,
        'status' => 1,
        'is_show' => 1,
        'children' => [
            [
                'menu_name' => '概况',
                'menu_key' => '插件标识_index',
                'menu_short_name' => '概况',
                'menu_type' => 1,
                'icon' => 'iconfont icongaikuang1',
                'api_url' => '插件标识/index',
                'router_path' => '插件标识/index',
                'view_path' => 'index/index',
                'methods' => 'get',
                'sort' => 100,
                'status' => 1,
                'is_show' => 1
            ],
            [
                'menu_name' => '管理',
                'menu_key' => '插件标识_manage',
                'menu_short_name' => '管理',
                'menu_type' => 1,
                'icon' => 'iconfont iconguanli',
                'api_url' => '插件标识/manage',
                'router_path' => '插件标识/manage/list',
                'view_path' => 'manage/list',
                'methods' => 'get',
                'sort' => 90,
                'status' => 1,
                'is_show' => 1,
                'children' => [
                    [
                        'menu_name' => '添加',
                        'menu_key' => '插件标识_manage_add',
                        'menu_short_name' => '添加',
                        'menu_type' => 2,  // 操作按钮
                        'api_url' => '插件标识/manage',
                        'methods' => 'post',
                        'is_show' => 0
                    ],
                    [
                        'menu_name' => '编辑',
                        'menu_key' => '插件标识_manage_edit',
                        'menu_short_name' => '编辑',
                        'menu_type' => 2,
                        'api_url' => '插件标识/manage/<id>',
                        'methods' => 'put',
                        'is_show' => 0
                    ],
                    [
                        'menu_name' => '删除',
                        'menu_key' => '插件标识_manage_del',
                        'menu_short_name' => '删除',
                        'menu_type' => 2,
                        'api_url' => '插件标识/manage/<id>',
                        'methods' => 'delete',
                        'is_show' => 0
                    ]
                ]
            ]
        ]
    ]
];
```

**重要**：菜单修改后需刷新菜单（开发->平台菜单/站点菜单->重置菜单）。

### 6. 前端开发（Admin 管理端）

#### API 接口定义

创建 `admin/api/插件标识/模块名.js`：

```javascript
import request from '@/utils/request'

/**
 * 获取列表
 */
export function getPage(data: any) {
    return request.post('/adminapi/插件标识/lists', data)
}

/**
 * 获取详情
 */
export function getInfo(id: number) {
    return request.get(`/adminapi/插件标识/info/${id}`)
}

/**
 * 添加
 */
export function add(data: any) {
    return request.post('/adminapi/插件标识/add', data)
}

/**
 * 编辑
 */
export function edit(id: number, data: any) {
    return request.put(`/adminapi/插件标识/edit/${id}`, data)
}

/**
 * 删除
 */
export function del(id: number) {
    return request.delete(`/adminapi/插件标识/del/${id}`)
}
```

#### 页面开发

创建 `admin/views/插件标识/模块名/list.vue`：

```vue
<template>
    <div>
        <!-- 搜索区域 -->
        <el-card class="box-card !border-none my-[10px] table-search-wrap">
            <el-form :inline="true" :model="tableData.searchParam" ref="searchFormRef">
                <el-form-item :label="t('字段名')" prop="字段名">
                    <el-input v-model="tableData.searchParam.字段名" />
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="loadList()">{{ t('search') }}</el-button>
                    <el-button @click="resetForm(searchFormRef)">{{ t('reset') }}</el-button>
                </el-form-item>
            </el-form>
        </el-card>

        <!-- 表格区域 -->
        <el-card class="box-card !border-none my-[10px] table-search-wrap">
            <div class="flex justify-between items-center">
                <span class="text-lg font-bold">{{ pageName }}</span>
                <el-button type="primary" @click="addFn">{{ t('add') }}</el-button>
            </div>
            
            <el-table :data="tableData.data" v-loading="tableData.loading">
                <el-table-column prop="id" :label="t('id')" min-width="100" />
                <el-table-column prop="字段名" :label="t('字段名')" min-width="150" />
                <el-table-column :label="t('operation')" fixed="right" min-width="120">
                    <template #default="{ row }">
                        <el-button type="primary" link @click="editFn(row.id)">{{ t('edit') }}</el-button>
                        <el-button type="danger" link @click="deleteFn(row.id)">{{ t('delete') }}</el-button>
                    </template>
                </el-table-column>
            </el-table>
            
            <div class="mt-[10px]">
                <el-pagination v-model:current-page="tableData.page"
                    v-model:page-size="tableData.limit"
                    layout="total, sizes, prev, pager, next, jumper"
                    :total="tableData.total"
                    @size-change="loadList()"
                    @current-change="loadList()" />
            </div>
        </el-card>
    </div>
</template>

<script lang="ts" setup>
import { ref, reactive, onMounted } from 'vue'
import { t } from '@/lang'
import { getPage, del } from '@/api/插件标识/模块名'
import { ElMessageBox } from 'element-plus'

const pageName = ref('管理列表')
const searchFormRef = ref()

// 列表数据
const tableData = reactive({
    page: 1,
    limit: 10,
    total: 0,
    loading: false,
    data: [],
    searchParam: {
        字段名: ''
    }
})

// 加载列表
const loadList = (page: number = 1) => {
    tableData.loading = true
    tableData.page = page
    
    getPage({
        page: tableData.page,
        limit: tableData.limit,
        字段名: tableData.searchParam.字段名
    }).then(res => {
        tableData.data = res.data.data.list
        tableData.total = res.data.data.count
        tableData.loading = false
    })
}

// 添加
const addFn = () => {
    // 跳转添加页面
}

// 编辑
const editFn = (id: number) => {
    // 跳转编辑页面
}

// 删除
const deleteFn = (id: number) => {
    ElMessageBox.confirm(t('确定删除吗？'), t('warning'), {
        confirmButtonText: t('confirm'),
        cancelButtonText: t('cancel'),
        type: 'warning'
    }).then(() => {
        del(id).then(() => {
            loadList()
        })
    })
}

// 重置表单
const resetForm = (formEl: any) => {
    if (!formEl) return
    formEl.resetFields()
    loadList()
}

onMounted(() => {
    loadList()
})
</script>

<style lang="scss" scoped></style>
```

### 7. DIY 页面装修开发

#### 自定义组件开发

创建 `admin/src/addon/插件标识/components/diy/组件名.vue`：

```vue
<template>
    <div class="diy-component">
        <!-- 组件内容 -->
    </div>
</template>

<script lang="ts" setup>
import { ref, watch } from 'vue'

const props = defineProps({
    value: {
        type: Object,
        default: () => ({})
    }
})

const data = ref({
    // 组件数据
})
</script>

<style lang="scss" scoped></style>
```

#### 组件注册

在 `app/dict/diy/ComponentDict.php` 中注册组件：

```php
<?php
return [
    '插件标识/组件名' => [
        'name' => '组件名称',
        'type' => '插件标识',
        'icon' => '',
        'group' => '基础组件',
        'default_value' => [
            // 默认配置
        ]
    ]
];
```

## 方法命名规范

| 操作 | 方法名 | 说明 |
|------|--------|------|
| 分页列表 | getPage | 返回分页数据 |
| 列表 | getList | 返回列表数据 |
| 详情 | getDetail | 返回关联表数据 |
| 信息 | getInfo | 返回单表数据 |
| 添加 | add | 添加数据 |
| 编辑 | edit | 编辑数据 |
| 删除 | del | 删除数据 |
| 修改字段 | modify字段名 | 修改指定字段 |

## 注意事项

1. **不修改框架核心代码**：所有二次开发通过插件实现
2. **菜单刷新**：修改菜单后需重置菜单才能生效
3. **站点套餐**：插件开发后需在站点套餐中勾选才能显示
4. **软删除**：模型使用软删除，不要真实删除数据
5. **site_id**：多站点数据需带上 site_id 条件

## 参考文档

详细文档参考：
- 官方文档：https://doc.press.niucloud.com/php/saas-framework/dev/pluginDev/introduction.html
- 插件目录结构：`references/plugin-directory-structure.md`
- 菜单开发详解：`references/menu-development.md`
- DIY组件开发：`references/diy-component-development.md`
