# niucloud-plugin-dev

NIUCLOUD-ADMIN SaaS 插件开发 Skill —— 用于创建并生成 niucloud admin saas 插件，涵盖前后端代码开发、菜单开发、DIY 页面装修开发等全流程。

## 📌 功能简介

本 Skill 为 WorkBuddy 提供 **NIUCLOUD-ADMIN SaaS 框架插件开发** 的完整工作流指导，帮助开发者：

- **创建插件**：生成符合框架规范的插件基础结构（`info.json`、`Addon.php`、`install.sql` 等）
- **后端开发**：Model 层、Service 层、Controller 层、Route 路由配置
- **前端开发**：Admin 管理端（Vue3 + Element Plus）、uni-app 移动端、Web 端（Nuxt.js）
- **菜单开发**：平台端/站点端菜单字典配置、操作按钮权限控制
- **DIY 页面装修**：自定义组件、页面模板、页面类型、自定义链接开发

## ⚡ 触发词

当用户输入包含以下关键词时，本 Skill 会自动加载：

| 类别 | 触发词 |
|------|--------|
| 插件创建 | 创建niucloud插件、开发niucloud插件、niucloud插件开发、生成niucloud插件 |
| 框架指向 | niucloud saas插件、开发niucloud admin插件 |
| 菜单开发 | 创建插件菜单、niucloud菜单开发 |
| 前端开发 | niucloud前端开发、niucloud后端开发 |
| DIY装修 | 开发DIY页面、DIY页面装修 |

## 🛠 技术栈

### 后端
| 技术 | 说明 |
|------|------|
| ThinkPHP | PHP Web 应用框架 |
| PHP | 编程语言 |
| MySQL | 数据库 |
| Redis | 缓存数据库 |
| Composer | 依赖管理工具 |
| RESTful | 编程风格 |

### 前端 - Admin 管理端
| 技术 | 说明 |
|------|------|
| Vue3 + Vite | 前端框架 + 构建工具 |
| TypeScript | 静态类型检查 |
| Vue Router | 前端路由管理 |
| Pinia | 状态管理 |
| Element Plus | UI 组件库 |
| Tailwind CSS + Sass | 样式方案 |
| Axios | HTTP 客户端 |
| Vue I18n | 国际化支持 |

### 前端 - uni-app 手机端
| 技术 | 说明 |
|------|------|
| Uni-app + Vite | 跨平台应用开发框架 |
| TypeScript | 静态类型检查 |
| Windi CSS | 原子化 CSS 框架 |
| uview-plus | UI 组件库 |

### 前端 - Web 端
| 技术 | 说明 |
|------|------|
| Nuxt.js | Vue SSR 应用框架 |
| Vue3 + Vite | 前端框架 + 构建工具 |
| Element Plus | UI 组件库 |
| Pinia | 状态管理 |

## 📂 Skill 目录结构

```
niucloud-plugin-dev/
├── SKILL.md                          # Skill 主文件（核心指导）
├── README.md                         # 本说明文件
├── references/                       # 参考文档（按需加载）
│   ├── plugin-directory-structure.md # 插件目录结构详解
│   ├── menu-development.md           # 菜单开发详解
│   └── diy-component-development.md  # DIY 组件/页面装修开发详解
└── assets/                           # 代码模板（可直接复用）
    └── admin-template/               # Admin 管理端模板
        ├── Addon.php                 # 插件主文件模板
        ├── Controller.php            # 控制器层模板
        ├── Model.php                 # 模型层模板
        ├── Service.php               # 服务层模板
        ├── Route.php                 # 路由配置模板
        ├── info.json                 # 插件配置模板
        ├── install.sql               # 安装 SQL 模板
        ├── unInstall.sql             # 卸载 SQL 模板
        ├── api.js                    # API 接口定义模板
        └── list.vue                  # 列表页面模板
```

## 🚀 使用流程

Skill 加载后，按以下步骤执行插件开发：

### 1. 收集插件信息
确认插件名称（英文标识）、中文名称、描述、类型（`app` 应用 / `addon` 插件）及功能模块。

### 2. 创建插件基础结构
生成 `info.json`（插件配置）、`Addon.php`（安装/卸载/升级）、`sql/` 目录下的 SQL 脚本。

### 3. 数据库设计
根据功能需求设计数据表，生成 `install.sql` / `unInstall.sql`，注意使用 `{{prefix}}` 表前缀变量与 `site_id` 站点隔离字段。

### 4. 后端开发
- **Model 层**：继承 `core\base\BaseModel`，支持软删除、类型转换、JSON 字段
- **Service 层**：继承 `core\base\BaseService`，遵循方法命名规范（getPage/getList/getInfo/add/edit/del/modifyXxx）
- **Controller 层**：继承 `BaseAdminController`，使用 `$this->request->params()` 接收参数
- **Route 路由**：配置管理端/前端 API 路由及中间件

### 5. 菜单开发
在 `app/dict/menu/` 下配置 `admin.php`（平台端）与 `site.php`（站点端）菜单字典：
- `menu_type = 0` 目录菜单
- `menu_type = 1` 菜单页面
- `menu_type = 2` 操作按钮（增删改查权限控制）

> ⚠️ **重要**：修改菜单后需登录平台端 → 【开发】→【平台菜单/站点菜单】→【重置菜单】才能生效。

### 6. 前端开发（Admin 管理端）
- `admin/api/插件标识/模块名.js`：API 接口定义
- `admin/src/addon/插件标识/views/`：页面视图（`view_path` 对应前端文件路径）

### 7. DIY 页面装修开发
- 在 `admin/src/addon/插件标识/components/diy/` 创建自定义组件
- 在 `app/dict/diy/` 注册组件（ComponentDict）、页面模板（PagesDict）、页面类型（TemplateDict）、自定义链接（LinkDict）
- 移动端通过 `diy-group` 组件渲染装修数据

## 📖 参考资料

- [NIUCLOUD 官方开发文档 - 插件开发](https://doc.press.niucloud.com/php/saas-framework/dev/pluginDev/introduction.html)
- 插件目录结构：`references/plugin-directory-structure.md`
- 菜单开发详解：`references/menu-development.md`
- DIY 组件开发：`references/diy-component-development.md`

## ⚠️ 开发注意事项

1. **不修改框架核心代码**：所有二次开发通过插件实现，保证框架升级兼容性
2. **菜单刷新**：修改菜单文件后必须重置菜单才生效
3. **站点套餐**：插件开发后需在站点套餐中勾选，界面才会显示
4. **软删除**：模型默认使用软删除，避免真实删除数据
5. **site_id 隔离**：多站点数据查询需带 `site_id` 条件
6. **接口唯一性**：框架已有接口不可修改，需新建 `_v2` 等新接口
