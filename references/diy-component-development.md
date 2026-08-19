# DIY 组件/页面装修开发详解

DIY（Do It Yourself）页面装修功能允许用户通过可视化拖拽方式创建自定义页面，无需编写代码。

## 概述

框架支持自定义页面装修，用户可以通过「自由可视化拖拽+组件配置+实时预览」的方式，无需代码开发即可自定义生成页面（如商城首页、活动页、个人中心页等）。

装修界面采用三栏式布局：
- **左侧**：组件库供用户选择
- **中间**：实时预览功能
- **右侧**：编辑和配置所选组件的各项属性

## 核心代码位置

### 框架实现的自定义功能
```
niucloud/app/dict/diy/
├── ComponentDict.php    # 自定义组件，以及加载插件的自定义组件
├── LinkDict.php        # 自定义链接，以及加载插件的自定义链接
├── PagesDict.php      # 自定义页面模板，以及加载插件的页面模板
└── TemplateDict.php   # 自定义页面类型，以及加载插件的页面类型
```

### 装修界面核心代码
```
admin/src/app/views/diy/edit.vue    # 整个装修界面的交互逻辑
admin/src/stores/modules/diy.ts    # 装修过程中的状态管理
```

### 移动端渲染组件
```
uni-app/src/addon/components/diy/group/    # diy-group 组件，负责解析和展示装修数据
uni-app/src/app/stores/diy.ts             # 移动端组件的数据获取、解析和渲染逻辑
```

## 数据存储结构

装修数据最终存储到数据表，主要包含两大部分：

### global - 整体页面数据
```json
{
  "global": {
    "title": "页面标题",
    "backgroundColor": "#ffffff",
    "textColor": "#333333",
    // 其他全局配置...
  }
}
```

### value - 组件集合
```json
{
  "value": [
    {
      "id": "组件唯一ID",
      "componentName": "组件名称",
      "value": {
        // 组件配置数据
      }
    }
  ]
}
```

## 插件开发自定义组件

### 1. 创建组件文件

在插件的前端目录创建 DIY 组件：

```
admin/src/addon/插件标识/components/diy/组件名.vue
```

### 组件模板

```vue
<template>
    <div class="diy-component" :style="componentStyle">
        <!-- 组件内容 -->
        <div class="component-content">
            {{ data.标题字段 }}
        </div>
    </div>
</template>

<script lang="ts" setup>
import { ref, computed, watch } from 'vue'

const props = defineProps({
    value: {
        type: Object,
        default: () => ({})
    }
})

// 组件数据
const data = ref(props.value)

// 计算样式
const componentStyle = computed(() => {
    return {
        backgroundColor: data.value.backgroundColor || '#ffffff',
        padding: data.value.padding || '10px',
        // 其他样式...
    }
})

// 监听数据变化
watch(() => props.value, (newVal) => {
    data.value = newVal
}, { deep: true })
</script>

<style lang="scss" scoped>
.diy-component {
    width: 100%;
    
    .component-content {
        // 组件样式
    }
}
</style>
```

### 2. 注册组件

在插件的字典文件中注册组件，创建 `app/dict/diy/ComponentDict.php`：

```php
<?php
return [
    '插件标识/组件名' => [
        'name' => '组件显示名称',
        'type' => '插件标识',
        'icon' => 'iconfont 图标类名',
        'group' => '组件分组（如：基础组件、营销组件）',
        'default_value' => [
            // 组件的默认配置数据
            'title' => '默认标题',
            'backgroundColor' => '#ffffff',
            'padding' => '10px',
            // 其他默认配置...
        ]
    ]
];
```

### 3. 开发组件配置面板

在 `admin/src/addon/插件标识/components/diy/组件名Config.vue` 创建配置面板：

```vue
<template>
    <div class="component-config">
        <el-form label-width="80px">
            <el-form-item label="标题">
                <el-input v-model="configData.title" />
            </el-form-item>
            
            <el-form-item label="背景色">
                <el-color-picker v-model="configData.backgroundColor" />
            </el-form-item>
            
            <!-- 更多配置项... -->
        </el-form>
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

const emit = defineEmits(['update:value'])

const configData = ref(props.value)

// 监听配置变化，实时更新
watch(configData, (newVal) => {
    emit('update:value', newVal)
}, { deep: true })
</script>
```

## 自定义页面类型

### 创建页面类型定义

在 `app/dict/diy/TemplateDict.php` 中注册页面类型：

```php
<?php
return [
    '插件标识/页面类型标识' => [
        'name' => '页面类型名称',
        'type' => '插件标识',
        'icon' => '/static/resource/图标路径.png',
        'default_value' => [
            'global' => [
                'title' => '页面标题',
                'backgroundColor' => '#f5f5f5'
            ],
            'value' => [
                // 默认组件列表
            ]
        ]
    ]
];
```

## 自定义页面模板

### 创建页面模板

在 `app/dict/diy/PagesDict.php` 中注册页面模板：

```php
<?php
return [
    '插件标识/模板标识' => [
        'name' => '模板名称',
        'type' => '插件标识',
        'icon' => '/static/resource/模板缩略图.png',
        'default_value' => [
            'global' => [
                'title' => '模板页面标题'
            ],
            'value' => [
                // 模板的组件列表
            ]
        ]
    ]
];
```

## 自定义链接

### 创建自定义链接

在 `app/dict/diy/LinkDict.php` 中注册自定义链接：

```php
<?php
return [
    '插件标识/链接标识' => [
        'name' => '链接名称',
        'type' => '插件标识',
        'url' => '/addon/插件标识/pages/页面路径',
        'need_login' => 0  // 是否需要登录
    ]
];
```

## uni-app 渲染自定义页面

### 在 uni-app 中使用 diy-group 组件

```vue
<template>
    <view class="page">
        <diy-group :diyData="diyData" />
    </view>
</template>

<script lang="ts" setup>
import { ref, onMounted } from 'vue'
import { useDiyStore } from '@/app/stores/diy'

const diyStore = useDiyStore()
const diyData = ref({})

onMounted(() => {
    // 获取DIY数据
    // 通常通过 API 获取页面装修数据
})
</script>
```

## 分享内容设置

在 `app/dict/diy/ShareDict.php` 中配置分享内容：

```php
<?php
return [
    '插件标识/页面标识' => [
        'title' => '分享标题',
        'desc' => '分享描述',
        'imgUrl' => '分享图片URL'
    ]
];
```

## 底部导航

自定义底部导航需要在相关配置文件中注册。

## 站点创建后初始化自定义页面数据

在插件安装时，可以通过 `Addon.php` 的 `install()` 方法初始化自定义页面数据。

## 注意事项

1. **组件唯一标识**：组件标识必须唯一，建议使用 `插件标识/组件名` 格式
2. **数据结构一致**：确保 `default_value` 的数据结构与组件期望的数据结构一致
3. **实时预览**：开发时需在装修界面测试实时预览效果
4. **多端兼容**：确保组件在 H5 和小程序端都能正常显示
5. **配置面板**：为每个组件开发对应的配置面板，提升用户体验

## 开发流程总结

1. 设计组件功能和外观
2. 创建组件 Vue 文件
3. 实现组件配置面板
4. 在字典文件中注册组件
5. 测试组件在装修界面的表现
6. 测试组件在移动端的渲染效果
