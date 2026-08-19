# 菜单开发详解

菜单是插件与用户交互的重要入口，niucloud-admin 框架提供了完善的菜单管理机制。

## 菜单文件位置

```
niucloud/addon/插件名称/app/dict/menu/
├── admin.php     # 平台端菜单
└── site.php      # 站点端菜单
```

## 菜单字段说明

| 字段名 | 说明 | 示例值 |
|--------|------|----------|
| menu_name | 菜单标题，出现在菜单项上的文字（建议四个字） | 商品管理 |
| menu_key | 菜单唯一标识key，不能重复 | shop_goods |
| menu_short_name | 菜单简写名称（建议2个字） | 商品 |
| parent_key | 父级菜单标识key，根菜单为空 | shop |
| parent_select_key | 父级菜单选中标识key | - |
| menu_type | 菜单类型(0:目录 1:菜单 2:按钮操作) | 0 |
| icon | 菜单的iconfont图标 | iconfont iconshangpinguanli |
| api_url | 接口请求地址，用于权限控制 | shop/goods |
| router_path | 浏览器访问路由地址 | shop/goods/list |
| view_path | 前端代码文件路径 | goods/list |
| methods | 请求方法(get/post/put/delete) | get |
| sort | 排序号，越大越靠前 | 95 |
| status | 状态(1:启用 0:禁用) | 1 |
| is_show | 是否显示(1:显示 0:隐藏) | 1 |
| children | 子菜单数组 | [...] |

## 菜单类型详解

### 1. 目录菜单 (menu_type = 0)

表示为目录菜单，不需要设置浏览器访问地址、也没有前端页面。

```php
<?php
return [
    [
        'menu_name' => 'Hello World管理',
        'menu_key' => 'hello_world',
        'menu_short_name' => 'Hello插件',
        'parent_key' => '',
        'parent_select_key' => '',
        'menu_type' => 0,
        'icon' => 'iconfont iconyingyongshichang',
        'api_url' => '',
        'router_path' => '',
        'view_path' => '',
        'methods' => '',
        'sort' => 100,
        'status' => 1,
        'is_show' => 1,
        'children' => []
    ]
];
```

### 2. 菜单页面 (menu_type = 1)

可以在浏览器中打开，必须设置 `router_path`、`view_path`。

```php
<?php
return [
    [
        'menu_name' => 'Hello World管理',
        'menu_key' => 'hello_world',
        'menu_type' => 0,
        'icon' => 'iconfont iconyingyongshichang',
        'router_path' => '',
        'sort' => 100,
        'status' => 1,
        'is_show' => 1,
        'children' => [
            [
                'menu_name' => '概况',
                'menu_key' => 'hello_world_index',
                'menu_short_name' => '概况',
                'menu_type' => 1,
                'icon' => 'iconfont icongaikuang1',
                'api_url' => 'hello_world/index',
                'router_path' => 'hello_world/index',
                'view_path' => 'index/index',
                'methods' => 'get',
                'sort' => 100,
                'status' => 1,
                'is_show' => 1
            ],
            [
                'menu_name' => '用户管理',
                'menu_key' => 'hello_world_user',
                'menu_short_name' => '用户',
                'menu_type' => 1,
                'icon' => 'iconfont iconzhanghu',
                'api_url' => 'hello_world/user',
                'router_path' => 'hello_world/user/list',
                'view_path' => 'user/list',
                'methods' => 'get',
                'sort' => 100,
                'status' => 1,
                'is_show' => 1,
                'children' => []
            ]
        ]
    ]
];
```

### 3. 功能操作菜单 (menu_type = 2)

定义功能操作菜单，用于权限控制。通常体现为弹框、功能操作。

```php
<?php
return [
    [
        'menu_name' => 'Hello World管理',
        'menu_key' => 'hello_world',
        'menu_type' => 0,
        'icon' => 'iconfont iconyingyongshichang',
        'router_path' => '',
        'sort' => 100,
        'status' => 1,
        'is_show' => 1,
        'children' => [
            [
                'menu_name' => '用户管理',
                'menu_key' => 'hello_world_user',
                'menu_type' => 1,
                'icon' => 'iconfont iconzhanghu',
                'api_url' => 'hello_world/user',
                'router_path' => 'hello_world/user/list',
                'view_path' => 'user/list',
                'methods' => 'get',
                'sort' => 100,
                'status' => 1,
                'is_show' => 1,
                'children' => [
                    [
                        'menu_name' => '添加用户',
                        'menu_key' => 'hello_world_user_add',
                        'menu_short_name' => '添加',
                        'menu_type' => 2,
                        'icon' => '',
                        'api_url' => 'hello_world/user',
                        'router_path' => '',
                        'view_path' => '',
                        'methods' => 'post',
                        'sort' => 0,
                        'status' => 1,
                        'is_show' => 0
                    ],
                    [
                        'menu_name' => '编辑用户',
                        'menu_key' => 'hello_world_user_edit',
                        'menu_short_name' => '编辑',
                        'menu_type' => 2,
                        'icon' => '',
                        'api_url' => 'hello_world/user/<id>',
                        'router_path' => '',
                        'view_path' => '',
                        'methods' => 'put',
                        'sort' => 0,
                        'status' => 1,
                        'is_show' => 0
                    ],
                    [
                        'menu_name' => '删除用户',
                        'menu_key' => 'hello_world_user_delete',
                        'menu_short_name' => '删除',
                        'menu_type' => 2,
                        'icon' => '',
                        'api_url' => 'hello_world/user/<id>',
                        'router_path' => '',
                        'view_path' => '',
                        'methods' => 'delete',
                        'sort' => 0,
                        'status' => 1,
                        'is_show' => 0
                    ]
                ]
            ]
        ]
    ]
];
```

## 前端页面路径映射

菜单定义中的 `view_path` 字段对应前端页面文件的路径。

**规则**：`admin/src/addon/插件标识/views/[view_path].vue`

例如：`view_path` 为 `user/list`，对应的文件路径为：
```
admin/src/addon/hello_world/views/user/list.vue
```

## 刷新菜单（重要）

每次修改菜单文件后，必须刷新菜单才能使更改生效。

**刷新步骤**：
1. 登录平台端
2. 点击【开发】->【平台菜单或站点菜单】->【重置菜单】
3. 刷新浏览器即可看到效果

## 菜单权限设置

### 平台端
在管理员角色功能中，可以添加/编辑菜单来控制操作权限。

### 站点端
在【权限管理】->【管理员角色】中，可以添加/编辑菜单来控制操作权限。

## 插件菜单的加载

1. 用户安装了插件
2. 点击添加站点套餐，勾选插件
3. 创建一个站点包含此套餐，站点才有插件菜单权限
4. 访问站点，即可看到新添加的插件菜单

### 应用与插件的菜单展示区别

#### 如果插件是应用
- 如果站点只有一个应用：应用子项菜单都会显示在一级
- 如果站点有多个应用：应用作为一级，子项作为二级

#### 如果插件不是应用（是插件）
- 在【应用管理】->【插件】-> 打开插件菜单子项

## 注意事项

### 框架标准菜单
- 平台管理端菜单项：`app/dict/menu/admin.php`
- 站点管理端菜单项：`app/dict/menu/site.php`
- **开发者不允许直接在 `sys_menu` 数据表中进行菜单项的操作，而必须在菜单字典中修改编辑**

### 插件菜单
- 插件安装时，框架会自动装载到菜单数据表 `sys_menu` 中
- 插件安装、卸载时，系统会自动装载、删除菜单
- 插件开发时，需在站点套餐中勾选，界面才会生效

### 系统菜单的特殊处理
可以通过菜单配置删除系统菜单（软删除）：
```php
return [
    'delete' => ["member"]  // 删除会员相关菜单
];
```

用于替换系统菜单功能为自己的功能，实现框架兼容升级。

## Icon 图标

菜单图标使用 iconfont 图标，格式为：`iconfont icon图标名称`

常用图标：
- `iconfont iconyingyongshichang` - 应用市场
- `iconfont icongaikuang1` - 概况
- `iconfont iconzhanghu` - 账户/用户
- `iconfont iconguanli` - 管理
- `iconfont iconshangpinguanli` - 商品管理

更多图标请参考框架的 iconfont 项目。
