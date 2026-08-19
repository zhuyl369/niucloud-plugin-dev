# 插件目录结构详解

以 `hello_world` 插件为例，详细介绍插件的标准目录结构及其功能说明。

## 完整目录结构

```
niucloud/
├─ addon/                                     # 插件目录
│   ├─ hello_world/                            # Hello World 插件
│   │   ├─ admin/                               # 管理端前端目录
│   │   │   ├── api/                            # 管理端API接口定义
│   │   │   ├── assets/                         # 静态资源文件
│   │   │   ├── lang/                           # 前端语言包
│   │   │   ├── layout/                         # 布局组件
│   │   │   └── views/                          # 页面视图
│   │   ├─ app/                                 # 后端业务代码
│   │   │   ├── adminapi/                       # 管理端API
│   │   │   │   ├── controller/                 # 控制器层，处理管理端请求
│   │   │   │   └── route/                     # 路由配置，定义管理端API路由
│   │   │   ├── api/                            # 前端API（移动端/web端共用）
│   │   │   │   ├── controller/                 # 控制器层，处理前端请求
│   │   │   │   └── route/                     # 路由配置，定义前端API路由
│   │   │   ├── dict/                           # 字典定义
│   │   │   │   └── menu/                      # 菜单配置
│   │   │   ├── job/                            # 定时任务
│   │   │   ├── lang/                           # 后端语言包
│   │   │   ├── listener/                       # 事件监听器
│   │   │   ├── model/                          # 数据模型
│   │   │   ├── service/                        # 业务服务层
│   │   │   │   ├── admin/                     # 管理端服务
│   │   │   │   ├── api/                       # 前端服务
│   │   │   │   └── core/                      # 核心服务
│   │   │   ├── upgrade/                        # 升级脚本
│   │   │   ├── validate/                       # 验证规则
│   │   │   └── event.php                       # 事件定义
│   │   ├─ compile/                             # 编译目录
│   │   │   ├── admin/                          # 管理端编译目录
│   │   │   ├── aliapp/                         # 移动端编译目录
│   │   │   ├── wap/                            # 移动端编译目录
│   │   │   ├── weapp/                          # 小程序编译目录
│   │   │   └── web/                            # web端编译目录
│   │   ├─ package/                             # 依赖包配置
│   │   │   ├── admin-package.json              # admin端依赖包
│   │   │   ├── composer.json                   # 主应用依赖包
│   │   │   ├── uni-app-package.json            # uni-app端依赖包
│   │   │   └── web-package.json                # web前端依赖包
│   │   ├─ resource/                            # 插件资源文件
│   │   ├─ sql/                                 # SQL文件
│   │   │   ├─ install.sql                      # 插件安装时自动执行
│   │   │   └─ unInstall.sql                    # 插件卸载时自动执行
│   │   ├─ uni-app/                             # 移动端前端目录
│   │   │   ├── api/                            # 移动端API接口定义
│   │   │   ├── components/                     # 公共组件
│   │   │   ├── hooks/                          # 钩子组件
│   │   │   ├── locale/                         # 语言包
│   │   │   ├── pages/                          # 页面视图
│   │   │   ├── static/                         # 静态资源
│   │   │   ├── stores/                         # 状态管理
│   │   │   ├── styles/                         # 样式表
│   │   │   └── utils/                          # 工具函数
│   │   ├─ web/                                 # web前端目录
│   │   │   ├── api/                            # web端API接口定义
│   │   │   ├── assets/                         # 静态资源文件
│   │   │   ├── lang/                           # 语言包
│   │   │   └── pages/                          # 页面视图
│   │   ├─ Addon.php                           # 插件主文件
│   │   └─ info.json                            # 插件配置文件
```

## 核心文件说明

### Addon.php - 插件主文件

每个插件必须包含的核心文件，用于管理插件的生命周期。

```php
<?php
namespace addon\hello_world\app;

class Addon
{
    /**
     * 插件安装执行
     */
    public function install()
    {
        // 安装时的初始化操作
        // 如：创建必要的数据、初始化配置等
        return true;
    }

    /**
     * 插件卸载执行
     */
    public function uninstall()
    {
        // 卸载时的清理操作
        // 注意：默认不会删除数据表，需手动处理
        return true;
    }

    /**
     * 插件升级执行
     */
    public function upgrade()
    {
        // 插件版本升级时的数据迁移等操作
        return true;
    }
}
```

### info.json - 插件配置文件

插件的基本配置信息，系统通过此文件识别和管理插件。

```json
{
  "title": "hello world",
  "desc": "Niucloud hello world演示插件",
  "key": "hello_world",
  "version": "1.0.0",
  "author": "niucloud",
  "type": "app",
  "support_app": "",
  "compile": [],
  "support_version": "1.1.7"
}
```

字段说明：
- `title`: 插件名称
- `desc`: 插件描述
- `key`: 插件标识（唯一）
- `version`: 插件当前版本
- `author`: 开发者名称
- `type`: 插件类型（`app` 应用 或 `addon` 插件）
- `support_app`: 支持的应用（为空表示通用）
- `compile`: 编译时包含的文件
- `support_version`: 支持的框架版本号

### install.sql - 安装SQL

插件安装时自动执行的SQL脚本。

```sql
CREATE TABLE IF NOT EXISTS `{{prefix}}hello_world` (
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL DEFAULT '' COMMENT '名称',
    `site_id` int NOT NULL DEFAULT 0,
    `create_time` int NOT NULL DEFAULT 0,
    `update_time` int NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='演示插件表';

INSERT INTO `{{prefix}}hello_world`(`id`, `name`) VALUES (1, '示例数据');
```

### unInstall.sql - 卸载SQL

插件卸载时自动执行的SQL脚本。

```sql
DROP TABLE IF EXISTS `{{prefix}}hello_world`;
```

## 命名规范

### 目录命名
- 插件标识使用小写字母 + 下划线（snake_case）
- 建议带公司/厂家前缀防止冲突

### 文件命名
- **控制器**: `模块名Controller.php`（如 `UserController.php`）
- **模型**: `模型名.php`（如 `User.php`）
- **服务层**: `模块名Service.php`（如 `UserService.php`）
- **前端视图**: `功能名.vue`（如 `list.vue`）

### 类命名
- **控制器**: `模块名Controller`（大驼峰）
- **模型**: `模型名`（大驼峰）
- **服务层**: `模块名Service`（大驼峰）

## 注意事项

1. 开发者应严格遵循目录结构规范
2. 插件标识（key）必须唯一
3. 数据表使用 `{{prefix}}` 变量以支持表前缀配置
4. 多站点插件需考虑 `site_id` 字段
5. 前端文件安装后会在对应端生成
