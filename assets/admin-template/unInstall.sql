-- NIUCLOUD 插件卸载 SQL 模板
-- 使用说明：复制此文件到 niucloud/addon/插件标识/sql/unInstall.sql

-- 删除数据表（慎用！建议在生产环境中保留数据）
-- 方式1：直接删除表
DROP TABLE IF EXISTS `{{prefix}}表名`;

-- 方式2：重命名表（推荐，可恢复）
-- RENAME TABLE `{{prefix}}表名` TO `{{prefix}}表名_deleted`;
