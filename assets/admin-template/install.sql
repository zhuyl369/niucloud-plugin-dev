-- NIUCLOUD 插件安装 SQL 模板
-- 使用说明：复制此文件到 niucloud/addon/插件标识/sql/install.sql

-- 创建数据表
CREATE TABLE IF NOT EXISTS `{{prefix}}表名` (
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `site_id` int NOT NULL DEFAULT 0 COMMENT '站点ID',
    `字段名` varchar(255) NOT NULL DEFAULT '' COMMENT '字段注释',
    `status` int NOT NULL DEFAULT 1 COMMENT '状态（1启用0禁用）',
    `sort` int NOT NULL DEFAULT 0 COMMENT '排序',
    `create_time` int NOT NULL DEFAULT 0 COMMENT '创建时间',
    `update_time` int NOT NULL DEFAULT 0 COMMENT '更新时间',
    `delete_time` int DEFAULT NULL COMMENT '删除时间（软删除）',
    PRIMARY KEY (`id`),
    KEY `idx_site_id` (`site_id`),
    KEY `idx_create_time` (`create_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='表注释';

-- 插入初始化数据（可选）
INSERT INTO `{{prefix}}表名`(`id`, `site_id`, `字段名`, `create_time`) 
VALUES (1, 0, '示例数据', UNIX_TIMESTAMP());
